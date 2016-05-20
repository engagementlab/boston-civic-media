/**
 * Boston Civic Media Website
 * Developed by Engagement Lab, 2016
 * ==============
 * 
 * EL homepage global JS
 * ==========
 */

/**
 * Waits for the first child image in the provided element to load and then dispatches provided callback.
 * @module utils
 * @param {jQuery selector} parentElem - The parent element containing image.
 * @param {function} callback - The callback function.
 */
imageLoaded = function(parentElem, callback) {

	parentElem.find('img').first().on('load', function() {

		// Image loaded, callback fires
		callback();

	})
	.each(function() {

		// Force image to dispatch 'load' (cache workaround)
	  if(this.complete) $(this).load();

	});

};

console.log ("syllabi stuff");

			var $grid = $('.syllabi').isotope({
			  itemSelector: '.syllabi-item'
			});

			// store filter for each group
			var filters = {};

			$('.filters').on( 'click', '.button', function() {
			  var $this = $(this);
			  // get group key
			  var $buttonGroup = $this.parents('.button-group');
			  var filterGroup = $buttonGroup.attr('data-filter-group');
			  // set filter for group
			  filters[ filterGroup ] = $this.attr('data-filter');
			  // combine filters
			  var filterValue = concatValues( filters );
			  // set filter for Isotope
			  $grid.isotope({ filter: filterValue });
			});

			// change is-checked class on buttons
			$('.button-group').each( function( i, buttonGroup ) {
			  var $buttonGroup = $( buttonGroup );
			  $buttonGroup.on( 'click', 'button', function() {
			    $buttonGroup.find('.is-checked').removeClass('is-checked');
			    $( this ).addClass('is-checked');
			  });
			});
			  
			// flatten object by concatting values
			function concatValues( obj ) {
			  var value = '';
			  for ( var prop in obj ) {
			    value += obj[ prop ];
			  }
			  return value;
			}

