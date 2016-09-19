/**
 * Created by 111 on 18.09.2016.
 */

function getXmlHttp(){
    var xmlhttp;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

function getStreetsList(injectedElement, value)
{
    injectedElement.setAttribute('disabled', 'disabled');
    var xmlhttp = getXmlHttp();
    xmlhttp.open('POST', '/getStreetsList', true);
    xmlhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4) {
            if(xmlhttp.status == 200) {
                while(injectedElement.firstChild){
                    injectedElement.removeChild(injectedElement.firstChild);
                }
                var arr = xmlhttp.responseText.split(';');
                arr.forEach(function(item){
                    var node = document.createElement('option');
                    var textNode = document.createTextNode(item);
                    node.appendChild(textNode);
                    injectedElement.appendChild(node);
                });
                injectedElement.removeAttribute("disabled");
            }
        }
    };
    xmlhttp.send('district='+encodeURIComponent(value));
}
