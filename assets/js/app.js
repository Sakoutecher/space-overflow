/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import '../css/app.css'

// Need jQuery? Install it with "yarn add jquery", then uncomment to import it.
import $ from 'jquery'

const $container = $('.js-vote-arrows')
$container.find('button').on('click', function (e) {
  e.preventDefault()
  const $button = $(e.currentTarget)
  $.ajax({
    url: '/answers/10/vote/' + $button.val(),
    method: 'POST'
  }).then(function (response) {
    $container.find('.js-vote-total').text(response.votes)
  })
})
