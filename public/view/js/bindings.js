$('[data-api-request]').on('click', function(e) {
   API.getOffersFromRequest($(e.target))
});
