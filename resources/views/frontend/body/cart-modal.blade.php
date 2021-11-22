<!-- Modal -->
<div class="modal fade" id="modalViewProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h5 class="modal-title"><strong id="pName"></strong></h5>

            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Product Image -->
                    <div class="col-md-4">
                        <div class="card" style="width: 18rem;">
                            <img src="" id="pImage" class="card-img-top img-responsive" alt="">

                        </div>
                    </div>
                    <!--  Product Image : End -->

                    <!-- Product Details -->
                    <div class="col-md-4">
                        <ul class="list-group">
                            <li class="list-group-item">Price:
                                <strong class="text-danger">$<span id="pPrice"></span></strong>
                                &nbsp;&nbsp;
                                <del class="text-muted" id="pOldPrice"></del>
                            </li>
                            <li class="list-group-item">Code: <strong id="pCode"></strong></li>
                            <li class="list-group-item">Category: <strong id="pCategory"></strong></li>
                            <li class="list-group-item">Brand: <strong id="pBrand"></strong></li>
                            <li class="list-group-item">Stock: <strong id="pStock"></strong></li>
                        </ul>
                    </div>
                    <!-- Product Details : End -->

                    <!-- Product Select Option -->
                    <div class="col-md-4">
                        <!-- Select Color-->
                        <div class="form-group">
                            <label for="pColor">Select Color</label>
                            <select class="form-control" id="pColor">
                            </select>
                        </div>

                        <!-- Select Size -->
                        <div class="form-group">
                            <label for="pSize">Select Size</label>
                            <select class="form-control" id="pSize">
                            </select>
                        </div>

                        <!-- Quantity -->
                        <div class="form-group">
                            <label for="pQty">Quantity</label>
                            <input type="number" value="1" class="form-control" min="1" id="pQty">
                        </div>

                        <!--Product Add to Cart Button -->
                        <input type="hidden" id="productId">
                        <button class="btn btn-primary"  onclick="addToCart()">Add To Cart</button>
                    </div>
                    <!--Product Select Option : End -->

                </div>
            </div>
        </div>
    </div>
</div>
