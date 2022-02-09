<div class="dropdown show float-right">
    <a class="btn btn-success dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
        aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-pencil"></i> Edit Gallery <i class="fa fa-sort-down"></i>
    </a>

    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <a class="dropdown-item" href="{{route('product.gallery.index', ['product'=>$id])}}">Image</a>
        <a href="#" data-toggle="modal" data-target="#modalAddImage" class="dropdown-item">Add Image</a>
        <a href="#" data-toggle="modal" data-target="#modalAddVideo" class="dropdown-item">Add Video</a>
        <a href="#" onclick="refreshFolder()" data-toggle="modal" data-target="#modalFolder"
            class="dropdown-item">Folder</a>
    </div>
</div>
