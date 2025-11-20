<!-- Modal picker with checkboxes -->
<div class="modal fade" id="barangayPicker" tabindex="-1" role="dialog" aria-labelledby="barangayPickerLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-scrollable" role="document">
	<div class="modal-content">
	<div class="modal-header text-center">
		<h6 class="modal-title" id="barangayPickerLabel">Select Barangay</h6>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">×</span>
		</button>
	</div>

	<div class="modal-body">
		<div class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input brgy" id="brgy1" value="Voluntary">
		<label class="custom-control-label" for="brgy1">Voluntary</label>
		</div>
		<div class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input brgy" id="brgy2" value="Voluntary1">
		<label class="custom-control-label" for="brgy2">Voluntary1</label>
		</div>
		<div class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input brgy" id="brgy3" value="Voluntary2">
		<label class="custom-control-label" for="brgy3">Voluntary2</label>
		</div>
		<div class="custom-control custom-checkbox">
		<input type="checkbox" class="custom-control-input brgy" id="brgy4" value="Voluntary3">
		<label class="custom-control-label" for="brgy4">Voluntary3</label>
		</div>
	</div>

	<div class="modal-footer">
		<button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Cancel</button>
		<button id="applyBarangay" type="button" class="btn btn-primary">Apply</button>
	</div>
	</div>
</div>
</div>