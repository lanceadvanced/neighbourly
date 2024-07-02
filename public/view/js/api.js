function API(){}

API.invoker = null;

API.getOffersFromRequest = function(invoker){
    API.invoker = invoker;
    let data = new FormData();
    data.append('requested_service', invoker.parent().find('input').val());
    console.log(data);
    $.ajax({
        headers: {
            "X-CSRF-TOKEN": $(`meta[name="csrf-token"]`).attr("content")
        },
        method: "post",
        url: invoker.attr('data-api-request'),
        contentType: false,
        processData: false,
        data: data,
        success: API.showResults
    });
}

API.showResults = function(results){
    let target = $(API.invoker.attr('data-target'));
    console.log(target);
    target.html(results);
}

