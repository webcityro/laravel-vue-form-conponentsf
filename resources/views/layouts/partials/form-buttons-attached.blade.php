<div class="row">
	<div class="col-12 form-group">
		<div class="row">
			<div class="col-6">
				<button v-if="!processing" :disabled="isDisabled" type="submit" class="btn btn-primary">
					<i class="fas fa-check fa-fw"></i> Save
				</button>
				<button v-else disabled class="btn btn-primary">
					<i class="fas fa-spinner fa-spin fa-fw"></i>
				</button>
			</div>
			<div class="col-2">
				<button type="button" :disabled="isDisabled" class="btn btn-warning" @click="reset">
					<i class="fas fa-eraser fa-fw"></i> Reset
				</button>
			</div>
			<div class="col-2" v-if="!isDisabled">
				<button type="button" class="btn btn-secondary" @click="disableEvent">
					<i class="fas fa-power-off fa-fw"></i> Disable
				</button>
			</div>
			<div class="col-2" v-if="isDisabled">
				<button type="button" class="btn btn-success" @click="enableEvent">
					<i class="fas fa-power-off fa-fw"></i> Ensable
				</button>
			</div>
			<div class="col-2">
				<button type="button" :disabled="isDisabled" class="btn btn-danger" @click="clear">
					<i class="fas fa-times fa-fw"></i> Clear
				</button>
			</div>
		</div>
	</div>
</div>
