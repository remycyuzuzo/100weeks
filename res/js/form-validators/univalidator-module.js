class HTML {
  /**
   *
   * @param {string} msg
   * @param {Element} el
   * @param {string} type default="danger"
   */
  static alert(msg, el, type = "danger") {
    this.el = el;
    const alertBox = document.createElement("div");
    alertBox.className = `text-${type} error`;
    alertBox.innerHTML = `${msg}`;
    this.el.parentElement.appendChild(alertBox);
  }

  static clearErrors(element) {
    if (element) element.remove();
  }
}

export default HTML;
