function textCounter(field, cnt, maxlimit) {
    var cntfield = document.getElementById(cnt)
     if (field.value.length >= maxlimit) {
        field.value = field.value.substring(0, maxlimit);
        cntfield.value = maxlimit - field.value.length;
     } else {
        cntfield.value = maxlimit - field.value.length;
     }
}