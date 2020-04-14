var is_requesting = false;
var waitInputTime = 1000;
var searchTimeout;

window.addEventListener('load', onPageLoaded);

var xhr = new XMLHttpRequest();

function onPageLoaded() {
    document.getElementById('input_field').onkeypress = function () {
        if (searchTimeout !== undefined) clearTimeout(searchTimeout);
        searchTimeout = setTimeout(makeRequest, waitInputTime);
    };
}

function makeRequest() {
    if (!is_requesting) {
        xhr.onload = function () {
            document.getElementById('result').innerHTML  = xhr.responseText;
        };
        console.log(createUrl(getFormValues()));
        xhr.open('GET', createUrl(getFormValues()), true);
        is_requesting = true;
        xhr.send();
        is_requesting = false;
    }
}
function getFormValues()
{
    let dict = {};
    Array.prototype.forEach.call(document.getElementById('input_form').elements, function(element) {
        if (element.hasAttribute('name')) {
            dict[element.name] = element.value;
        }
    });
    return dict;
}

function createUrl(dict={}) {
    let url = window.location.href;
    if (Object.keys(dict).length) {
        url += '?';
    }
    for (let [key, value] of Object.entries(dict)) {
        url += `${key}=${value}&`;
    }
    return encodeURI(url.slice(0, -1));
}
