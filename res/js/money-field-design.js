(function () {
  // grab all money fields
  const moneyFields = document.querySelectorAll(".money");

  moneyFields.forEach((moneyField) => {
    let appendText = moneyField.hasAttribute("data-rate") ? "%" : "Rwf";
    moneyField.outerHTML = `<div class="input-group">${moneyField.outerHTML}
    <div class="input-group-append"><span class="input-group-text">${appendText}</span></div>`;
  });
})();
