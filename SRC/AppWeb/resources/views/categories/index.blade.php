@extends('layouts.admin')

@section('title')
    <title>Category List</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
@include('categories.modal')
<main class="main">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Category</li>
    </ol>
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">New Category</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Category Name</label>
                                <input id="category-name" type="text" name="name" class="form-control" required>
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            </div>
                            <div class="form-group">
                                <label for="parent_id">Parent</label>
                                <select id="parent-id" name="parent_id" class="form-control">
                                    <option value="">None</option>
                                    @foreach ($parent as $row)
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger">{{ $errors->first('name') }}</p>
                            </div>
                            <div class="form-group">
                                <button id="submit" class="btn btn-primary btn-sm">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Category List</h4>
                            <p>{{date('l jS \of F Y h:i:s A')}}</p>
                        </div>
                        <div class="card-body">

                            <div id="success-alert" class="alert alert-success" style="display:none"> New Category Added! </div>
                            <div id="success-update-alert" class="alert alert-success" style="display:none"> Category Updated! </div>

                            <div class="table-responsive">
                                <table id="category-table" class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Parent</th>
                                            <th>Created At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="data-table">
                                    </tbody>
                                </table>
                            </div>
                            {!! $category->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script>
$(document).ready(function(){
    load();
});

function load(){
    var dataTable = $("#data-table");
    var route = "{{route('category.listing')}}";

    $("#data-table").empty();
    $.get(route, function(res){
        $(res).each(function(key,value){
            if(value.parent != null){
                dataTable.append("<tr id='category_" + value.id + "'><td>" + value.id + "</td><td><strong>" + value.name + "</strong></td><td>" + value.parent +  "</td><td>" +  value.created_at  + "</td><td><button value="+value.id+" OnClick='Show(this);' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#myModal'>Edit</button><button class='btn btn-danger btn-sm' value="+value.id+" OnClick='Delete(this);'>Delete</button></td></tr>" )
            }
            else{
                dataTable.append("<tr id='category_" + value.id + "'><td>" + value.id + "</td><td><strong>" + value.name + "</strong></td><td>" + "-" +  "</td><td>" +  value.created_at  + "</td><td><button value="+value.id+" OnClick='Show(this);' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#myModal'>Edit</button><button class='btn btn-danger btn-sm' value="+value.id+" OnClick='Delete(this);'>Delete</button></td></tr>" )
            }
        })
    });
}

$("#submit").click(function(){
    var category_name = $("#category-name").val();
    var parent_id =  $("#parent-id").val();
    var route = "{{route('category.store')}}";
    var token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: route,
        headers: {'X-CSRF-TOKEN': token},
        type: 'POST',
        dataType: 'json',
        data:{name: category_name, parent_id: parent_id},
        success:function(response){
            $("#success-alert").fadeIn();
            if(response.category.parent_id != null){
                $("#data-table").append("<tr id='category_" + response.category.id + "'><td>" + response.category.id + "</td><td><strong>" + response.category.name + "</strong></td><td>" + response.parent +  "</td><td>" +  response.category.created_at  + "</td><td><button value="+response.category.id+" OnClick='Show(this);' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#myModal'>Edit</button><button class='btn btn-danger btn-sm' value="+response.category.id+" OnClick='Delete(this);'>Delete</button></td></tr>" )
            }
            else{
                $("#data-table").append("<tr id='category_" + response.category.id + "'><td>" + response.category.id + "</td><td><strong>" + response.category.name + "</strong></td><td>" + "-" +  "</td><td>" +  response.category.created_at  + "</td><td><button value="+response.category.id+" OnClick='Show(this);' class='btn btn-warning btn-sm' data-toggle='modal' data-target='#myModal'>Edit</button><button class='btn btn-danger btn-sm' value="+response.category.id+" OnClick='Delete(this);'>Delete</button></td></tr>" )
            }
        }
    });
});

function Show(btn){
	var route = "http://127.0.0.1:8000/administrator/category/"+btn.value+"/edit";
    
	$.get(route, function(res){
		$("#category-name-modal").val(res.category.name);
        //$("#parent-id-modal").val(res.parent_id);
		$("#id").val(res.category.id);
        $("#parent-id-modal").empty();
        if(res.parent != null){
            $("#parent-id-modal").append('<option value=' + res.category.parent_id  + ' selected>' + res.parent +'</option>');
        }
        else{
            $("#parent-id-modal").append('<option value="" selected>None</option>');
        }
        res.categories.forEach(function(item) {
            $("#parent-id-modal").append('<option value="'+ item.id +'">'+item.name+'</option>');
        });
	});
}

$("#actualizar").click(function(){
	var value = $("#id").val();
	var name = $("#category-name-modal").val();
    var parent_id = $("#parent-id-modal").val();
	var route = "http://127.0.0.1:8000/administrator/category/"+value+"";
    var token = $('meta[name="csrf-token"]').attr('content');

	$.ajax({
		url: route,
		headers: {'X-CSRF-TOKEN': token},
		type: 'PUT',
		dataType: 'json',
		data: {name: name, parent_id: parent_id},
		success: function(){
			load();
			$("#myModal").modal('toggle');
			$("success-update-alert").fadeIn();
		}
	});
});


function Delete(btn){
	var route = "http://127.0.0.1:8000/administrator/category/"+btn.value+"";
    var token = $('meta[name="csrf-token"]').attr('content');

	$.ajax({
		url: route,
		headers: {'X-CSRF-TOKEN': token},
		type: 'DELETE',
		dataType: 'json',
		success: function(){
			//load();
			$("success-update-alert").fadeIn();
            $('#category_'+btn.value).fadeOut("slow");
		}
	});
}



</script>


@endsection