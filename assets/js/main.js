// fonction pour copier quelque chose dans le presse papier
function copyToClipboard(element) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(element).select();
    document.execCommand("copy");
    $temp.remove();
    alert("Lien copié dans le presse-papier !");
}