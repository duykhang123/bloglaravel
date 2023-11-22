$(function () {
    initForm($("body"));
  });
  
$('#check-all').change(function () {
    var checked = $(this).prop('checked');
    $(".list-content input[type='checkbox']").prop("checked", checked);
});

function submitForm(link) {
    if (confirm('bạn chắc chắn muốn xóa')) {
        $('#admin_Form').attr('action', link);
        $('#admin_Form').submit();
    }
}

const initForm = (parent) => {
    if (parent.find(".my-confirm").length > 0) {
        parent
            .find(".my-confirm")
            .off("click")
            .on("click", function (e) {
                e.preventDefault();
                const href = $(this).attr("href");
                const title = $(this).attr("data-title-modal");
                const isAjax = $(this).attr("data-ajax") || false;
                $("body").append(`
              <div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="confirm-modal">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <h4 class="modal-title">{Title}</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                          <button type="button" class="btn btn-primary" jsbtn="1">Yes</button>
                      </div>
                  </div>
              </div>
          </div>`);
                $("#confirm-modal .modal-title").text(title);
                $("#confirm-modal").modal("show");
                $('[jsbtn="1"]').on("click", function () {
                    $("#confirm-modal").modal("hide");
                    if (isAjax) {
                        $.ajax({
                            url: href,
                            success: function (response) {
                                $("#confirm-modal").remove();
                            },
                        });
                    } else {
                        location.href = href;
                    }
                });
            });
    }
};

function submitStatus(link) {
    $('#admin_Form').attr('action', link);
    $('#admin_Form').submit();
}

var loadFile = function (event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('output');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
};

function readURL(input) {
    if (input.files) {
        for (let i = 0; i < input.files.length; i++) {
            var reader = new FileReader();

            reader.onload = function (e) {
                let img = $('<img style="width: 150px">').attr('src', e.target.result);
                $('.images').append(img)
            };
            reader.readAsDataURL(input.files[i]);
        }
    }
}

function addTag(link) {
    var input = $('#txtTag').val();
    if (input != '') {
        $.ajax({
            url: link,
            data: { 'tagname': input },
            dataType: "html",
            success: function (data) {
                $('#listTag').html(data);
                $('#txtTag').val('');
            }
        });
    }
}

function removeTag(link, id) {
    $.ajax({
        url: link,
        data: { 'id': id },
        dataType: "html",
        success: function (data) {
            $('#listTag').html(data);
        }
    });
}

function ajaxStatus(link, id) {
    $.ajax({
        url: link,
        data: { 'id': id },
        dataType: "json",
        success: function (data) {
            var classAdd = 'btn-success';
            var classRemove = 'btn-danger';
            var textActive = 'Active';
            var textInactive = 'Inactive';
            if (data.status == '0') {
                classAdd = 'btn-danger';
                classRemove = 'btn-success';
                textActive = 'Inactive';
                textInactive = 'Active';
            }
            $("#status-" + data.id).text(textActive);
            $("#status-" + data.id).remove(textInactive);
            $("#status-" + data.id).addClass(classAdd);
            $("#status-" + data.id).removeClass(classRemove);
            $("#status-" + data.id).attr("href", "javascript:ajaxStatus('" + data.link + "'," + data.id + ")");
        }
    });
}

function ajaxSpecial(link, id) {
    $.ajax({
        url: link,
        data: { 'id': id },
        dataType: "json",
        success: function (data) {
            var classAdd = 'btn-success';
            var classRemove = 'btn-danger';
            var textActive = 'Active';
            var textInactive = 'Inactive';
            if (data.special == '0') {
                classAdd = 'btn-danger';
                classRemove = 'btn-success';
                textActive = 'Inactive';
                textInactive = 'Active';
            }
            $("#special-" + data.id).text(textActive);
            $("#special-" + data.id).remove(textInactive);
            $("#special-" + data.id).addClass(classAdd);
            $("#special-" + data.id).removeClass(classRemove);
            $("#special-" + data.id).attr("href", "javascript:ajaxSpecial('" + data.link + "'," + data.id + ")");
        }
    });
}

$("select[name='select_filter']").change(function () {
    $(this).parents("form").submit();
})

function changeField(id, text) {
    $("#option-select").text("Search by " + text);
    $("input[name='search_field']").val(id);
}



function clearForm() {
    $("input[name='search_field']").val("all");
    $("input[name='search_value']").val('');
    $('#adminForm').submit();
}