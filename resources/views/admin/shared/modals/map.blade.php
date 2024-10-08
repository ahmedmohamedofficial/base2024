<div class="modal fade accepted-modal without-bg-modal" id="staticBackdrop_4" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">

                <div class="map">
                    <div class="form-group">
                        <input type="text" id="mapSearch" class="main-input">
                        <div id="map" class="custom-map"></div>
                    </div>
                    <input type="hidden" name="lat" id="lat" value="{{ isset($row->lat) ? $row->lat : 23.885942 }}">
                    <input type="hidden" name="lng" id="lng" value="{{isset($row->lng) ?  $row->lng : 45.079162 }}">

                </div>
            </div>
        </div>

    </div>
</div>