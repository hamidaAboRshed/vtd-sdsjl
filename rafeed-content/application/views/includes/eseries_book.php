// Create the flipbook

flipbook.turn({
		
		// Magazine width

		width: 1100,

		// Magazine height

		height: 400,

		// Duration in millisecond

		duration: 1000,

		// Enables gradients

		gradients: true,
		
		// Auto center this flipbook

		autoCenter: true,

		// Elevation from the edge of the flipbook when turning a page

		elevation: 50,

		// The number of pages

		pages: 50,

		// Events

		when: {
			turning: function(event, page, view) {
				
				var book = $(this),
				currentPage = book.turn('page'),
				pages = book.turn('pages');
		
				// Update the current URI

				Hash.go('page/' + page).update();

				// Show and hide navigation buttons

				disableControls(page);

			},

			turned: function(event, page, view) {

				disableControls(page);

				$(this).turn('center');

				$('#slider').slider('value', getViewNumber($(this), page));

				if (page==1) { 
					$(this).turn('peel', 'br');
				}

			},

			missing: function (event, pages) {

				// Add pages that aren't in the magazine

				for (var i = 0; i < pages.length; i++)
					addPage(pages[i], $(this));

			}
		}

});

