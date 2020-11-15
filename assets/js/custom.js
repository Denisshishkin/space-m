"use strict";

jQuery(document).ready(function ($) {
  // Check if webp
  function ThisIsWebP() {
    var def = $.Deferred(),
        crimg = new Image();

    crimg.onload = function () {
      def.resolve();
    };

    crimg.onerror = function () {
      def.reject();
    };

    crimg.src = "https://simpl.info/webp/cherry.webp";
    return def.promise();
  }

  ThisIsWebP().then(function () {
    //Есть поддержка webp2
    $('body').addClass('webp');
  }, function () {
    //Нет поддержки webp
    $('body').addClass('no-webp');
  });
});