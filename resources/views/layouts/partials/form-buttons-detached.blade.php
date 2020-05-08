<div class="row">
	<div class="col-12 form-group">
		<div class="row">
			<sc-form-trigger group="{{ $group }}" emit="submit" v-cloak>
				<div class="col-6" slot-scope="{ isDisabled, processing, trigger }">
					<button type="submit" :class="['btn', 'btn-primary', {'is-disabled': isDisabled}]"
						@click="trigger">
						<span v-if="!processing">
							<i class="fas fa-check fa-fw"></i> Submit
						</span>
						<span v-else>
							<i class="fas fa-spinner fa-spin fa-fw"></i> Loading...
						</span>
					</button>
				</div>
			</sc-form-trigger>
			<sc-form-trigger group="{{ $group }}" emit="reset" v-cloak>
				<div class="col-2" slot-scope="{ isDisabled, processing, trigger }">
					<button type="button" :class="['btn', 'btn-warning', {'is-disabled': isDisabled}]"
						@click="trigger">
						<i class="fas fa-eraser fa-fw"></i> Reset
					</button>
				</div>
			</sc-form-trigger>
			<sc-form-trigger group="{{ $group }}" emit="disableStarted" v-cloak>
				<div class="col-2" v-if="!isDisabled" slot-scope="{ isDisabled, processing, trigger }">
					<button type="button" :class="['btn', 'btn-secondary', {'is-disabled': isDisabled}]"
						@click="trigger">
						<i class="fas fa-power-off fa-fw"></i> Disable
					</button>
				</div>
			</sc-form-trigger>
			<sc-form-trigger group="{{ $group }}" emit="disableEnded" v-cloak always-enabled>
				<div class="col-2" v-if="isDisabled" slot-scope="{ isDisabled, processing, trigger }">
					<button type="button" :class="['btn', 'btn-success', {'is-disabled': isDisabled}]"
						@click="trigger">
						<i class="fas fa-power-off fa-fw"></i> Ensable
					</button>
				</div>
			</sc-form-trigger>
			<sc-form-trigger group="{{ $group }}" emit="clear" v-cloak>
				<div class="col-2" slot-scope="{ isDisabled, processing, trigger }">
					<button type="button" :class="['btn', 'btn-danger', {'is-disabled': isDisabled}]"
						@click="trigger">
						<i class="fas fa-times fa-fw"></i> Clear
					</button>
				</div>
			</sc-form-trigger>
		</div>
	</div>
</div>
