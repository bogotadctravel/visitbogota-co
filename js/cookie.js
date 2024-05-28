/**
 * This function create a cookie
 * @param {string} cname  The name of var
 * @param {mixed} cvalue The values of the var
 * @param {int} exdays Days of expire
 * @param {String} path   The path of cookie
 */
function setCookie(cname, cvalue, exdays, path='') {
    var d = new Date();
    d.setTime(d.getTime() + (exdays*24*60*60*1000));
    var expires = "expires="+ d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/"+path;
}
/**
 * Return the value of a cookie
 * @param  {string} cname The name of the cookie
 * @return {string}       The value found or null if it not exists
 */
function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return null;
}
/**
 * This function delete a cookie
 * @param  {string} name The name of the cookie
 */
function deleteCookie(name) {
    setCookie(name,'',-1);
}