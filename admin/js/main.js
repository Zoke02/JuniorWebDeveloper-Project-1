// .click for closeing the opening Categories and Menu. Jquery

$(document).ready(function () {
    $('#menu-toogle').click(function () {
        $('.menu').toggle();
        $('.menu-categories').hide();
    });
});

$(document).ready(function () {
    $('#categories-toogle').click(function () {
        $('.menu-categories').toggle();
        $('.menu').hide();
    });
});

// Function to search jobs by Title. JavaScript
function search() {
    var input, filter, box, cards, card_title, i, txtValue;
    input = document.getElementById('search');
    filter = input.value.toUpperCase();
    box = document.getElementsByClassName('box');
    cards = document.getElementsByClassName('cards');
    card = document.getElementsByClassName('card');
    for (i = 0; i < cards.length; i++) {
        card_title = card[i].getElementsByClassName('card__title')[0];
        txtValue = card_title.textContent || card_title.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            cards[i].style.display = '';
        } else {
            cards[i].style.display = 'none';
        }
    }
}

// Function to refresh the page after 60 sec of inactivity.

$(document).ready(function () {
    var time = new Date().getTime();
    $(document.body).bind('mousemove keypress mouseleave', function () {
        time = new Date().getTime();
    });

    function refresh() {
        if (new Date().getTime() - time > 60000) window.location.reload(true);
        else setTimeout(refresh, 10000);
    }
    setTimeout(refresh, 10000);
});

// Functions to validate a form

function validateContactForm() {
    let email = document.getElementById('email').value;
    let message = document.getElementById('message').value;
    if (email == '' || message == '') {
        if (email == '' && message == '') {
            alert('Email and Message must be filled out.');
        } else if (email == '') {
            alert('Email must be filled out.');
        } else if (message == '') {
            alert('Please write us a message.');
        }
        return false;
    } else {
        alert('Thank you for your submission.');
        document.getElementById('contact').reset();
        return true;
    }
}

// Cookies and welcome message

function setCookie(cookieName, cookieValue, exDays) {
    // First get actual date.
    const date = new Date();
    // Cookie Name
    cookieName = 'newsEmail';
    // .setTime adds the ammount of time.
    date.setTime(date.getTime() + exDays * 24 * 60 * 60 * 1000);
    let expires = 'expires=' + date.toUTCString();
    document.cookie =
        cookieName + '=' + cookieValue + ';' + expires + ';path=/';
}

function getCookie(cookieName) {
    let name = cookieName + '=';
    let splitCookie = document.cookie.split(';');
    for (let i = 0; i < splitCookie.length; i++) {
        let c = splitCookie[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return '';
}

function checkCookies() {
    let isCookieSet = getCookie('newsEmail');
    if (!isCookieSet) {
        rejected = 'rejected';
        user = prompt(
            'Welcome. You can enter your E-Mail Adress for our newsletter!',
            ''
        );
        if (user != '' && user != null) {
            setCookie('newsEmail', user, 30);
        } else {
            setCookie('newsEmail', rejected, 30);
        }
    }
}

window.onload = function () {
    checkCookies();
};
