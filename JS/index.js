$(".form")
  .find("input, textarea")
  .on("keyup blur focus", function (e) {
    var $this = $(this),
      label = $this.prev("label");

    if (e.type === "keyup") {
      if ($this.val() === "") {
        label.removeClass("active highlight");
      } else {
        label.addClass("active highlight");
      }
    } else if (e.type === "blur") {
      if ($this.val() === "") {
        label.removeClass("active highlight");
      } else {
        label.removeClass("highlight");
      }
    } else if (e.type === "focus") {
      if ($this.val() === "") {
        label.removeClass("highlight");
      } else if ($this.val() !== "") {
        label.addClass("highlight");
      }
    }
  });

$(".tab a").on("click", function (e) {
  e.preventDefault();

  $(this).parent().addClass("active");
  $(this).parent().siblings().removeClass("active");

  target = $(this).attr("href");

  $(".tab-content > div").not(target).hide();

  $(target).fadeIn(600);
});

window.addEventListener("DOMContentLoaded", (event) => {
  const inputFields = document.querySelectorAll(
    ".field-wrap input, .field-wrap textarea"
  );

  inputFields.forEach((input) => {
    input.addEventListener("input", (event) => {
      const inputField = event.target;
      const label = inputField.nextElementSibling;

      if (inputField.value !== "") {
        label.classList.add("filled");
      } else {
        label.classList.remove("filled");
      }
    });

    if (input.value !== "") {
      input.nextElementSibling.classList.add("filled");
    }
  });
});
