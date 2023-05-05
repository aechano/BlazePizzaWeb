var li_elements = document.querySelectorAll(".menu-layout div");
var item_elements = document.querySelectorAll(".item");
for (var i = 0; i < li_elements.length; i++) {
  li_elements[i].addEventListener("click", function() {
    li_elements.forEach(function(li) {
      li.classList.remove("active");
    });
    this.classList.add("active");
    var li_value = this.getAttribute("data-div");
    item_elements.forEach(function(item) {
      item.style.display = "none";
    });
    if (li_value == "hotty") {
      document.querySelector("." + li_value).style.display = "flex";
    } else if (li_value == "pizza") {
      document.querySelector("." + li_value).style.display = "flex";
    }else if (li_value == "taketwo") {
      document.querySelector("." + li_value).style.display = "flex";
    }else if (li_value == "lpizza") {
      document.querySelector("." + li_value).style.display = "flex";
    }else if (li_value == "digDeals") {
      document.querySelector("." + li_value).style.display = "flex";
    }else if (li_value == "cheesy") {
      document.querySelector("." + li_value).style.display = "flex";
    }else if (li_value == "desserts") {
      document.querySelector("." + li_value).style.display = "flex";
    }else if (li_value == "drinks") {
      document.querySelector("." + li_value).style.display = "flex";
    }else {
      console.log("");
    }
  });
}
