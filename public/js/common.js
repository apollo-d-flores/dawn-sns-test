$(function(){
    // メインとサイドバーのmin-heightを、ブラウザに合わせる
    var headH = $("header").height();
    var winH = $(window).height();
    $("#mainContent").css("min-height", winH - headH);
    $("#container").css("min-height",winH - headH);
    $("#sideBar").css("min-height",winH -headH);

    // ヘッダーのスライドメニュー開閉
    $("#menu").on("click",function() {
        var $arrow = $("#userMenuArrow .arrow");
        if ($arrow.hasClass("close")) {
            $("#userMenuArrow .arrow").removeClass("close");
            $("#userMenuArrow .arrow").addClass("open");
            $("nav.user-menu").slideToggle();  
        } else if ($arrow.hasClass("open")) {
          $("#userMenuArrow .arrow").removeClass("open");
          $("#userMenuArrow .arrow").addClass("close");
          $("nav.user-menu").slideToggle();  
        }
    });

    // 投稿編集モーダルを開く
    $(".edit-btn").on("click",function() {
        var no = $(this).children(".post-no").text();
        var post = $(this).closest(".user-post").find("p.post").text();
        $("#editModal form textarea").text(post);
        $("#editModal form input[class='edit-post-no']").val(no);

        $("#overlay").css("display","block");
        $("#editModal").css("display","block");
    });

    // モーダルの外をクリックしてモーダルを閉じる
    $("#overlay").on("click",function() {
          $("#overlay").css("display","none");
          $(".modal").css("display","none");
    });

    // アップロードした画像ファイルのサムネイル表示
    $("input[type=file]").change(function() {
        if ($(".upload-thumbnail").length) {
            $(".upload-thumbnail").remove();
        }
        // サムネとして表示するためのページ上の領域を用意
        $(this).closest('label').after('<div class="upload-thumbnail"></div>');

        // アップロードファイル
        var file = $(this).prop("files")[0];

        // アップロードファイルが画像以外の場合、処理を停止
        if (!file.type.match("image.*")) {
            // クリア
            $(this).val("");
            $(".upload-thumbnail").remove();
            return;
        }

        // 画像表示
        var reader = new FileReader();
        reader.onload = function() {
            var img_src = $("<img>").attr("src", reader.result);
            $(".upload-thumbnail").html(img_src);
        }
        reader.readAsDataURL(file);
    });
});