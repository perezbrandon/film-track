var movies = new Bloodhound({
    datumTokenizer: function (datum) {
        return Bloodhound.tokenizers.whitespace(datum.value);
    },
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    limit: 6,
    remote: {
        url: 'http://api.themoviedb.org/3/search/movie?api_key=decdf2868fc78b532b852fe494a0712d&query=%QUERY&search_type=ngram',
        filter: function (movies) {
            // Map the remote source JSON array to a JavaScript array
            return $.map(movies.results, function (movie) {
                return {
                    value: movie.original_title,
                    year: (movie.release_date.substr(0, 4) ? movie.release_date.substr(0, 4) : ''),
                    poster_image : movie.poster_path,
                    overview: movie.overview,
                };
            });
        }
    }
});



movies.initialize();

$('.movie-search').typeahead({
    hint: true,
    highlight: true
  }, {
    displayKey: 'value',
    source: movies.ttAdapter(),
    templates: {
        empty: [
            '<div class="empty-message">',
            'Unable to find movie with that title.',
            '</div>'].join('\n'),
        suggestion: Handlebars.compile('<p><strong>{{value}}</strong> – {{year}}</p>')
    }

  }).bind("typeahead:selected", function (obj, datum, name) {
    $('#label_year').css("display","");
    $('#label_desc').css("display","");
    $('#year').val(datum.year);
    $('#year2').html(datum.year);
    $('#poster-path').val("http://image.tmdb.org/t/p/w342/"+datum.poster_image);
    $('#Movie-desc').val(datum.overview);
    $('#Movie-desc2').html(datum.overview);
    $('#poster').attr('src', "http://image.tmdb.org/t/p/w154/"+datum.poster_image);

});
