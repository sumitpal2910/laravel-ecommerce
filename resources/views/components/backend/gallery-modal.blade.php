<!--Add Image modal-->
<div class="modal center-modal fade " id="modalAddImage" tabindex="-1" aria-modal="true"
    style="display: block; padding-right: 17px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formAddImage" action="#" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{$id}}">
                <input type="hidden" name="type" value="1">
                <div class="modal-header">
                    <h5 class="modal-title">Add Image </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input target="#imageInputDiv" onchange="changeVideoType(event)" name="path_type"
                                type="radio" id="imageLink" class="with-gap radio-col-primary" checked="" value="2">
                            <label for="imageLink">Upload an existing Image link</label>
                            <br>
                            <input target="#imageInputDiv" onchange="changeVideoType(event)" name="path_type"
                                type="radio" id="imageLocal" class="with-gap radio-col-primary" value="1">
                            <label for="imageLocal">Upload from Device</label>
                        </div>
                        <div class="col-md-12" id="imageInputDiv">

                            <div class="link-div form-group">
                                <label for=""> Link </label>
                                <input type="text" class="form-control" name="path" id="path"
                                    placeholder="https://example.com/link">
                            </div>

                            <div class="file-div d-none">
                                <div class="form-group ">
                                    <label for=""> Folder </label>
                                    <input type="hidden" name="folder_id" class="folder-id" value="0">
                                    <input type="text" class="form-control folder-name" name="folder"
                                        value="Your Directory" readonly disabled>

                                    <p class="folder-parent">Save in <b>Your Directory</b>
                                        <a onclick="refreshFolder()" data-toggle="modal" data-target="#modalFolder"
                                            href="#" class="text-primary"> change...</a>
                                    </p>
                                </div>
                                <div class="form-group ">
                                    <label for=""> Images </label>
                                    <input type="file" class="form-control" name="images" multiple>
                                    <small class="text-secondary">Maximum size 2mb</small>
                                </div>
                                <div id="imageProgress" class="progress d-none">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-uniform">
                    <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-rounded btn-primary float-right">Save </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Videos modal -->
<div class="modal center-modal fade " id="modalAddVideo" tabindex="-1" aria-modal="true"
    style="display: block; padding-right: 17px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="formAddVideo" action="#" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" value="{{$id}}">
                <input type="hidden" name="type" id="" value="2">
                <div class="modal-header">
                    <h5 class="modal-title">Add Video </h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input target="#videoInputDiv" onchange="changeVideoType(event)" name="path_type"
                                type="radio" id="videoExt" class="with-gap radio-col-primary" checked="" value="2">
                            <label for="videoExt">Upload an existing video from Youtube or Vimeo</label>
                            <br>
                            <input target="#videoInputDiv" onchange="changeVideoType(event)" name="path_type"
                                type="radio" id="videoLocal" class="with-gap radio-col-primary" value="1">
                            <label for="videoLocal">Upload from Device</label>
                        </div>
                        <div class="col-md-12" id="videoInputDiv">

                            <div class="link-div form-group">
                                <label for=""> Link </label>
                                <input type="text" class="form-control" name="path" id=""
                                    placeholder="https://example.com/link">
                            </div>

                            <div class="file-div d-none">
                                <div class="form-group ">
                                    <label for=""> Folder </label>
                                    <input type="hidden" name="folder_id" class="folder-id" value="0">
                                    <input type="text" class="form-control folder-name" name="folder"
                                        value="Your Directory" readonly disabled>

                                    <p class="folder-parent">Save in <b>Your Directory</b>
                                        <a onclick="refreshFolder()" data-toggle="modal" data-target="#modalFolder"
                                            href="#" class="text-primary"> change...</a>
                                    </p>
                                </div>

                                <div class="form-group ">
                                    <label for=""> Video </label>
                                    <input type="file" class="form-control" name="video" id="">
                                    <small class="text-secondary">Maximum size 90mb</small>
                                </div>
                                <div id="videoProgress" class="progress d-none">
                                    <div class="progress-bar" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>

                                <div class="form-group">
                                    <label for="">Cover Image</label>
                                    <input type="file" name="cover_image" class="form-control" id="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-uniform">
                    <button type="button" class="btn btn-rounded btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-rounded btn-primary float-right">Save </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Folder Modal-->
<div class="modal center-modal fade " id="modalFolder" tabindex="-1" aria-modal="true"
    style="display: block; padding-right: 17px;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Folder </h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body ">
                <div class="row">
                    <div class="col-12">
                        <div id="jstree">
                            <!-- in this example the tree is populated from inline HTML -->
                        </div>
                    </div>

                    <div class="col-12 mt-3" id="folderButtonDiv">
                        <a onclick="showFolderInput()" href="#" class="btn btn-primary btn-sm">
                            <i class="fa fa-folder"></i> <sup>+</sup>
                        </a>
                        <p class="folder-parent">Currently you are in <b>Your Directory</b>
                            <a class="text-primary" onclick="setFolderIdName({'id':'0','text':'Your Directory'})"
                                href="#" title="root directory">...</a>
                        </p>
                    </div>

                    <div class="col-12  d-none mt-3" id="folderInputDiv">
                        <form action="" class="row" id="createFolderForm" method="post">
                            <div class="col-md-6">
                                <input type="hidden" name="parent_id" class="folder-id" value="0">
                                <input type="text" class="form-control" placeholder="folder name" name="name">
                                <p class="folder-parent">create folder inside <b>Your Directory</b>
                                    <a class="text-primary"
                                        onclick="setFolderIdName({'id':'0','text':'Your Directory'})" href="#"
                                        title="root directory">...</a>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary btn-md ">Create</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>

            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-primary float-right">Select</button>
            </div>
        </div>
    </div>
</div>
