/**
 * Created by Z003RE3C on 8/16/2018.
 */
$(function () {
    showList();
    $("#edit-user .submit").click(function () {
        var editUser=$("#edit-user");
        var name=editUser.find("input[name='name']").val();
        var author=editUser.find("input[name='author']").val();
        var param={};
        param["name"]=name;
        param["author"]=author;
        $.ajax({
            url:"./query.php",
            type:"POST",
            data:param,
            dataType:"json",
            success:function (data) {
                if(data.res){
                    alert("添加成功");
                    $('#myModal').modal('hide');
                    showList();
                }else {
                    alert(data.data);
                }
            }
        })
    })
})
function showList() {
    $.ajax({
        url:"./query.php",
        type:"GET",
        dataType:"json",
        success:function (data) {
            if(data.res){
                var books=data.data;
                var trTpl="<tr> <td></td> <td></td> <td></td> <td></td> </tr>";
                $("#user-tbody").empty();
                for(var i=0;i<books.length;i++){
                    var tr=$(trTpl);
                    tr.find("td:eq(0)").text(books[i].name);
                    tr.find("td:eq(1)").text(books[i].author);
                    tr.find("td:eq(2)").text(books[i].created);
                    var a = '<button class="btn btn-primary id="books[i],id" btn-lg" data-toggle="modal" data-target="#UpdateModal" onclick=update('+books[i].id+')'+'>'+'Update'+'</button>';
                    tr.find("td:eq(3)").append(a);
                    $("#user-tbody").append(tr);
                }
            }else {
                alert(data.data);
            }
        }
    })
}

function update(id) {
    var request = {};
    request['id'] = id; 
    $.ajax({
        url:"./query.php",
        type:"POST",
        data:request,
        dataType:"json",
        success:function (data) {
            if(data.res){
                var res = data.data;
                $("#book input").val(res.name);
                $("#author input").val(res.author);
                $("#UpdateModal .modal-footer button").attr("row-id", id);
                // console.log(data.data);
                }else {
                alert(data.data);
            }
        }
    })
}

 $("#update-user .submit").click(function (e) {
       
        // console.log(e);
        // console.log(e.target);
        // console.log($(e.target).attr('row-id'));
        //获取事件点击对象 -> 对应的行id （此时还未委托事件） 
        var row_id = $(e.target).attr('row-id');
        var updateUser=$("#update-user");
        var name=updateUser.find("input[name='name']").val();
        var author=updateUser.find("input[name='author']").val();
        var param={};
        param["name"]=name;
        param["author"]=author;
        param['row_id']=row_id;
        param["flag"] = "update"; 
        $.ajax({
            url:"./query.php",
            type:"POST",
            data:param,
            dataType:"json",
            success:function (data) {

                if(data.res){

                    alert("修改成功");
                    $('#UpdateModal').modal('hide');
                    showList();
                }else {
                    alert(data.data);
                }
            }
        })
    })




