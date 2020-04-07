<div class="row">
	<div class="col-12 form-group">
		<div class="row">
			<div class="col-8">
				<sc-form-trigger
					group="{{ $group }}"
					emit="submit"
					v-cloak
				>
					<button
						type="submit"
						:class="['btn', 'btn-primary', {'is-disabled': disabled}]"
						slot-scope="{ disabled, processing, trigger }"
						@click="trigger"
					>
						<span v-if="!processing">
							<i class="fas fa-check fa-fw"></i> Submit
						</span>
						<span v-else>
							<i class="fas fa-spinner fa-spin fa-fw"></i> Loading...
						</span>
					</button>
				</sc-form-trigger>
			</div>
			<div class="col-2">
				<sc-form-trigger
					group="{{ $group }}"
					emit="reset"
					v-cloak
				>
					<button
						type="button"
						:class="['btn', 'btn-warning', {'is-disabled': disabled}]"
						slot-scope="{ disabled, processing, trigger }"
						@click="trigger"
					>
						<i class="fas fa-eraser fa-fw"></i> Reset
					</button>
				</sc-form-trigger>
			</div>
			<div class="col-2">
				<sc-form-trigger
					group="{{ $group }}"
					emit="clear"
					v-cloak
				>
					<button
						type="button"
						:class="['btn', 'btn-danger', {'is-disabled': disabled}]"
						slot-scope="{ disabled, processing, trigger }"
						@click="trigger">
						<i class="fas fa-times fa-fw"></i> Clear
					</button>
				</sc-form-trigger>
			</div>
		</div>
	</div>
</div>
