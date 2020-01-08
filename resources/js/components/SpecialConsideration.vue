<template>
	<div>
		<button @click="$modal.show('add_consideration')" class="button">Manage Consideration</button>
		<modal
			name="add_consideration"
			height="auto"
			:adaptive="true"
			scrollable="scrollable"
		>
		<div class="section">
			<form @submit.prevent="addConsideration">
				<div class="control">
				  <textarea v-model="Form.consideration" class="textarea is-focused" placeholder="Focused textarea"></textarea>
				</div>
				<button type="submit" class="button is-info is-fullwidth mt-medium mb-small">Add</button>
			</form>
			<div>
				<div class="mb-small" style="white-space: pre-line" v-for="(consideration, index) in dbconsiderations">
					<span v-text="'* ' + consideration.consideration"></span>
					<i class="fas fa-trash" style="cursor: pointer;" @click="remove(consideration, index)"></i>
				</div>
			</div>
		</div>

		</modal>
	</div>
	
</template>

<script>
	export default {
		props: ['course'],
		data () {
			return {
				dbconsiderations: [],
				Form: new Form({
					consideration: '',
				}),
			}
		},

		created() {
			axios.get(`/api/${this.course.slug}/getconsiderations`)
			.then(data => {
				this.dbconsiderations = data.data;
			})
			.catch(error => {
				flash('Unable to retrieve considerationsn', 'failed');
			});
		},

		methods: {
			remove(consideration, index)
			{
				this.Form.delete(`/api/${consideration.id}/delete`)
				.then(data => {
		            this.dbconsiderations.splice(index, 1);
					flash('Item Deleted.', 'success');
				})
				.catch(error => {
					flash('Could not delete item, contact admin', 'failed');
				})
			},
			addConsideration() {
				this.Form.post(`/api/${this.course.slug}/addconsideration`)
                    .then(data => {
                            this.Form.reset();
                            this.dbconsiderations.unshift(data);
                            flash('Consideration Added.', 'success');
                    })
                .catch(error => {
                    flash('We were unable to process your form', 'failed');
                });
			}
		}
	}
</script>