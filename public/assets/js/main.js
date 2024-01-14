//form validation login & register


new Swiper('.portfolio-details-slider', {
  speed: 400,
  autoplay: {
    delay: 5000,
    disableOnInteraction: false
  },
  pagination: {
    el: '.swiper-pagination',
    type: 'bullets',
    clickable: true
  }
});

/**
 * Testimonials slider
 */
new Swiper('.testimonials-slider', {
  speed: 600,
  loop: true,
  autoplay: {
    delay: 5000,
    disableOnInteraction: false
  },
  slidesPerView: 'auto',
  pagination: {
    el: '.swiper-pagination',
    type: 'bullets',
    clickable: true
  },
  breakpoints: {
    320: {
      slidesPerView: 1,
      spaceBetween: 40
    },

    1200: {
      slidesPerView: 3,
    }
  }
});

/**
 * Animation on scroll
 */
function aos_init() {
  AOS.init({
    duration: 1000,
    easing: "ease-in-out",
    once: true,
    mirror: false
  });
}

window.addEventListener('load', () => {
  aos_init();
});

  tinymce.init({
  selector: 'textarea',
  plugins: 'ai tinycomments mentions anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed permanentpen footnotes advtemplate advtable advcode editimage tableofcontents mergetags powerpaste tinymcespellchecker autocorrect a11ychecker typography inlinecss',
  toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | align lineheight | tinycomments | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
  tinycomments_mode: 'embedded',
  tinycomments_author: 'Author name',
  mergetags_list: [
{value: 'First.Name', title: 'First Name'},
{value: 'Email', title: 'Email'},
  ],
  ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
});


//search option in tags ==============================================

const selectBox = document.querySelector('.select-box');
const selectOption = document.querySelector('.select-option');
const soValue = document.getElementById('soValue');
const optionSearch = document.getElementById('optionSearch');
const options = document.querySelector('.options');
const optionList = document.querySelectorAll('.options li');

selectOption.addEventListener('click', function ()
{
  selectBox.classList.toggle('active');
});

optionList.forEach(function(optionListSingl) {
  optionListSingl.addEventListener('click', function() {
    text = this.textContent;
    soValue.value = text;
    selectBox.classList.remove('active');
  });
});

optionSearch.addEventListener('keyup', function (){
  var filter , li , i, textValue;

  filter = optionSearch.value.toUpperCase();
  console.log(filter)
  li = options.getElementsByTagName('li');
  for(i = 0 ; i < li.length; i++)
  {
    liCount = li[i];
    textValue = liCount.textContent || liCount.innerHTML;
    if(textValue.toUpperCase().indexOf(filter) > -1)
    {
        li[i].style.display = '';
    }
    else
      li[i].style.display = 'none';
  }

})




//category select==================================




const selectBtn = document.querySelector(".select-btn"),
    items = document.querySelectorAll(".item");

selectBtn.addEventListener("click", () => {
  selectBtn.classList.toggle("open");
});

items.forEach(item => {
  item.addEventListener("click", () => {
    item.classList.toggle("checked");

    let checkedItems = document.querySelectorAll(".item.checked"),
        btnText = document.querySelector(".btn-text");

    if (checkedItems && checkedItems.length > 0) {
      btnText.innerText = `${checkedItems.length} Selected`;
    } else {
      btnText.innerText = "Select Tags";
    }
  });
});




let balise = document.getElementById('balise');
let chihaja = document.querySelectorAll('.chihaja');
chihaja.forEach((item, index) => {
  item.addEventListener('click', (e) => {
    let categoryId = item.getAttribute('data-category-id');
    balise.value = categoryId;
    console.log(categoryId);
  });
});

let tags = document.getElementById('tags');
let checked = document.querySelectorAll('.checked');
let arr = [] ;
checked.forEach((item , index)=>{
  item.addEventListener('click',(e)=>{

    let tag = item.textContent;

    if(!arr.includes(item.textContent))
    {
      arr.push(item.textContent);
      // tags.value = arr.join(', ');
    }else {
      console.log('Tag already exists in the array');
    }

    console.log(arr)
    tags.value = arr;
  })
})



//Search Using AJAX
document.addEventListener("DOMContentLoaded", function () {
  var searchInput = document.getElementById("search");
  var searchResultContainer = document.getElementById("search_result");

  searchInput.addEventListener("keyup", function () {
    var input = searchInput.value;

    if (input !== "") {
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "search.php", true);
      xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

      xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
          // Clear previous results
          searchResultContainer.innerHTML = "";
          // Append the new search results
          searchResultContainer.innerHTML += xhr.responseText;
          searchResultContainer.style.display = "flex";
        }
      };

      xhr.send("input=" + input);
    } else {
      // Handle the case when the search input is empty
      searchResultContainer.innerHTML = "";
      searchResultContainer.style.display = "none";
    }
  });
});
