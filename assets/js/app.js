/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you require will output into a single css file (app.css in this case)


import 'bootstrap-material-design';

require('../css/app.css');

import '@fortawesome/fontawesome-free/css/all.css';

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');



$("#article_kartinka").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });

