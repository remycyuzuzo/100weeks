
<?php

class UploadImage
{
    // MEMBER PROPERTIES
    /**
     * @var array storage for the global array
     */
    private $_files = array();

    /**
     * @var string storage for any errors
     */
    private $error = '';

    /**
     * @var string The new image name, to be provided or will be generated
     */
    protected $name;

    /**
     * @var int The image width in pixels
     */
    protected $width;

    /**
     * @var int The image height in pixels
     */
    protected $height;

    /**
     * @var string The image mime type (extension)
     */
    protected $mime;

    /**
     * @var string The full image path (dir + image + mime)
     */
    protected $path;

    /**
     * @var string The folder or image storage storage
     */
    protected $storage;

    /**
     * @var array The min and max image size allowed for upload (in bytes)
     */
    protected $size = array(100, 3500000);

    /**
     * @var array The max height and width image allowed
     */
    protected $dimensions = array(5000, 5000);

    /**
     * @var array The mime types allowed for upload
     */
    protected $mimeTypes = array('jpeg', 'png', 'gif', 'jpg');

    /**
     * @var array list of known image types
     */
    protected $acceptedMimes = array(
        1 => 'gif', 'jpeg', 'png', 'swf', 'psd',
        'bmp', 'tiff', 'tiff', 'jpc', 'jp2', 'jpx',
        'jb2', 'swc', 'iff', 'wbmp', 'xbm', 'ico'
    );


    public function __construct($_files)
    {
        /* check if php_exif is enabled */
        if (!function_exists('exif_imagetype')) {
            $this->error = 'Function \'exif_imagetype\' Not found. Please enable \'php_exif\' in your PHP.ini';
            return false;
        }

        $this->_files = $_files;
    }

    /**
     * Returns error string
     *
     * @return string
     */
    public function getError()
    {
        return $this->error;
    }

    /**
     * Validate directory/permission before creating a folder.
     *
     * @param $dir string the folder name to check
     *
     * @return bool
     */
    private function isDirectoryValid($dir)
    {
        return !file_exists($dir) && !is_dir($dir) || is_writable($dir);
    }

    public function getFullPath()
    {
        return $this->storage;
    }

    /**
     * Gets the real image mime type.
     *
     * @param $tmp_name string The upload tmp directory
     *
     * @return null|string
     */
    protected function getImageMime($tmp_name)
    {
        $this->mime = @$this->acceptedMimes[exif_imagetype($tmp_name)];
        if (!$this->mime) {
            return null;
        }

        return $this->mime;
    }

    /**
     * Validate image size, dimension or mimetypes
     *
     * @return boolean
     */
    protected function constraintValidator()
    {
        /* check image for valid mime types and return mime */
        $this->getImageMime($this->_files['tmp_name']);


        /* validate image mime type */
        if (!in_array($this->mime, $this->mimeTypes)) {
            $this->error = sprintf('Invalid File! Only (%s) image types are allowed', implode(', ', $this->mimeTypes));
            return false;
        }

        /* get image sizes */
        list($minSize, $maxSize) = $this->size;


        /* check image size based on the settings */
        if ($this->_files['size'] < $minSize || $this->_files['size'] > $maxSize) {
            $min = $minSize . ' bytes (' . intval($minSize / 1000) . ' kb)';
            $max = $maxSize . ' bytes (' . intval($maxSize / 1000) . ' kb)';
            $this->error = 'Image size should be minimum ' . $min . ', upto maximum ' . $max;
            return false;
        }

        return true;
    }

    /**
     * Define a mime type for uploading.
     *
     * @param array $fileTypes
     *
     * @return $this
     */
    public function setMime(array $fileTypes)
    {
        $this->mimeTypes = $fileTypes;
        return $this;
    }

    /**
     * This function removes all special character in a string especially for file names
     */
    public static function clearFileName(string $name)
    {
        $name = strtolower(str_replace(' ', '-', $name));
        $name = preg_replace('/[^A-Za-z0-9\-]/', '', $name);
        return $name;
    }

    public function setName($isNameProvided = null)
    {
        if ($isNameProvided != null) {
            $this->name = filter_var($isNameProvided, FILTER_SANITIZE_STRING);
            $this->name = $this->clearFileName($this->name);
        } else {
            $this->name = uniqid('', true) . '_' . str_shuffle(implode(range('e', 'q')));
        }

        return $this;
    }

    /**
     * Creates a storage for upload storage.
     *
     * @param $dir string the folder name to create
     * @param int $permission chmod permission
     *
     * @return $this
     */
    public function setStorage($dir = 'uploads', $permission = 0666)
    {
        $isDirectoryValid = $this->isDirectoryValid($dir);

        if (!$isDirectoryValid) {
            $this->error = 'Can not create a directory  \'' . $dir . '\', please check write permission';
            return false;
        }

        $create = !is_dir($dir) ? @mkdir('' . $dir, (int) $permission, true) : true;

        if (!$create) {
            $this->error = 'Error! directory \'' . $dir . '\' could not be created';
            return false;
        }

        $this->storage = $dir;

        return $this;
    }

    /**
     * Returns the storage / folder name.
     *
     * @return string
     */
    public function getStorage()
    {
        if (!$this->storage) {
            $this->setStorage();
        }

        return $this->storage;
    }

    /**
     * Sets the location where th image will be updated
     * @param string $path
     */
    public function setLocation(string $path)
    {
        $this->setStorage($path);
        $this->storage = $path;
    }


    /**
     * Returns the image name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * Returns the image mime type.
     *
     * @return null|string
     */
    public function getMime()
    {
        if (!$this->mime) {
            $this->mime = $this->getImageMime($this->_files['tmp_name']);
        }

        return $this->mime;
    }


    /**
     * Returns the full path of the image ex 'storage/image.mime'.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path = $this->getStorage() . '/' . $this->getName() . '.' . $this->getMime();
    }

    /**
     * Validate and save (upload) file
     *
     * @return false|Image
     */
    public function upload()
    {
        if ($this->error !== '') {
            return false;
        }

        $isValid = $this->constraintValidator();
        $this->setName();

        $isSuccess = $isValid && $this->isSaved($this->_files['tmp_name'], $this->getPath());

        return $isSuccess ? $this : false;
    }

    /**
     * Final upload method to be called, isolated for testing purposes.
     *
     * @param $tmp_name int the temporary storage of the image file
     * @param $destination int upload destination
     *
     * @return bool
     */
    protected function isSaved($tmp_name, $destination)
    {
        return move_uploaded_file($tmp_name, $destination);
    }
}
