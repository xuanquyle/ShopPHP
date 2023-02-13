// 1.Them da re chuot vao khi chon thanh phan trong menu
//2.Menu Toggle


//
// 1.Them da re chuot vao khi chon thanh phan trong menu

// let list = document.querySelectorAll('.navigation li')

// function activeLink(){
//     list.forEach((item) =>
//     item.classList.remove('hovered'));
//     this.classList.add('hovered');
// }
// list.forEach((item) =>{
//     item.addEventListener('click',activeLink);
// })

//
//2.Menu Toggle
//
function loadDash() {
    $("ul").ready(function () {
        setTimeout(function () {
            $("li:nth-child(2)").addClass('hovered');
        }, 20);
    });
}

let toggle = document.querySelector('.toggle');
let navigation = document.querySelector('.navigation');
let main = document.querySelector('.main');

toggle.onclick = function () {
    navigation.classList.toggle('active')
    main.classList.toggle('active')
}
//
//LOAD PAGE
//
// jQuery(document).ready(function ($) {
//     $(window).load(function () {
//         setTimeout(function () {
//             $('body').fadeOut('slow', function () {});
//         }, 5000); // set the time here
//     });
// });

function firstLoad() {
    // $(".content").load('Dashboard.php');
    $("ul").ready(function () {
        setTimeout(function () {
            $("li:nth-child(1)").trigger('click');
        }, 10);
    });
}



function loadOrderList() {
    $("ul").ready(function () {
        setTimeout(function () {
            $("li:nth-child(4)").addClass('hovered');
        }, 10);
    });
}

function loadProduct() {
    $("ul").ready(function () {
        setTimeout(function () {
            $("li:nth-child(5)").addClass('hovered');
        }, 20);
    });

}


//
//PRODUCTS