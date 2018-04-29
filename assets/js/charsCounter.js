/*
 * Cette fonction permet de mettre à jour un compteur de caractères et de maintenir une limite (très utile pour la biographie qui est limitée à 500 caractères)
 * 
 */

function textCounter(field, cnt, maxlimit) {
    var cntfield = document.getElementById(cnt)
     if (field.value.length >= maxlimit) {
        field.value = field.value.substring(0, maxlimit);
        cntfield.value = maxlimit - field.value.length;
     } else {
        cntfield.value = maxlimit - field.value.length;
     }
}