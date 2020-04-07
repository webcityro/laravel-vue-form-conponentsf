<template>
	<div v-show="show" :class="computedWrapperCssClass" :style="computedWrapperCssStyle">
		<label
			v-if="label"
			:for="identity"
			:class="computedLabelCssClass"
			:style="computedLabelCssStyle"
		>{{ label }}</label>
		<!-- <textarea
			:ref="identity"
			:disabled="isDisabled"
		></textarea>-->
		<ckeditor
			:editor="editor"
			:config="computedConfig"
			:disabled="isDisabled"
			tag-name="textarea"
			v-model="body"
			@input="update"
		></ckeditor>
		<slot name="validation">
			<sc-validation
				:label="label"
				:id="identity"
				:name="name"
				:show="showValidation"
				:css-class="computedValidationCssClass"
				:validation="validation"
				:error="error"
			/>
		</slot>
	</div>
</template>

<script>
import Toolbar from "./Toolbar";
import Colors from "./Colors";
import BaseInput from "../BaseInput";

// import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
import ClassicEditor from '@ckeditor/ckeditor5-editor-classic/src/classiceditor';
import EssentialsPlugin from '@ckeditor/ckeditor5-essentials/src/essentials';
import BoldPlugin from '@ckeditor/ckeditor5-basic-styles/src/bold';
import ItalicPlugin from '@ckeditor/ckeditor5-basic-styles/src/italic';
import UnderlinePligin from '@ckeditor/ckeditor5-basic-styles/src/underline';
import StrikethroughPligin from '@ckeditor/ckeditor5-basic-styles/src/strikethrough';
import CodePligin from '@ckeditor/ckeditor5-basic-styles/src/code';
import SubscriptPligin from '@ckeditor/ckeditor5-basic-styles/src/subscript';
import SuperscriptPligin from '@ckeditor/ckeditor5-basic-styles/src/superscript';
import LinkPlugin from '@ckeditor/ckeditor5-link/src/link';
import clipboardPlugin from '@ckeditor/ckeditor5-clipboard/src/clipboard';
import HeadingPlugin from '@ckeditor/ckeditor5-heading/src/heading';
import FontPlugin from '@ckeditor/ckeditor5-font/src/font';
import CKEditor from '@ckeditor/ckeditor5-vue';

export default {
	mixins: [BaseInput],

	components: {
		ckeditor: CKEditor.component
	},

	props: {
		contentsCss: { type: String, required: false },
		config: { type: Object, required: false, default: () => { return {}; } }
	},

	data() {
		return {
			initialBody: this.$slots.body ? this.$slots.body[0].children[0].text : '',
			editor: ClassicEditor,
			default: {
				plugins: [
					EssentialsPlugin,
					BoldPlugin,
					ItalicPlugin,
					LinkPlugin,
					FontPlugin,
					HeadingPlugin,
					UnderlinePligin,
					StrikethroughPligin,
					CodePligin,
					SubscriptPligin,
					SuperscriptPligin,
					clipboardPlugin,
				],
				// toolbar: this.toolbar(),
				toolbar: {
					items: [
						'heading',
						'bold',
						'italic',
						'underline',
						'strikethrough',
						'code',
						'subscript',
						'superscript',
						'link',
						'undo',
						'redo',
						'fontSize',
						'fontFamily',
						'fontColor',
						'fontBackgroundColor',
						'essentials'
					]
				},
				fontSize: {
					options: [
						9,
						11,
						13,
						'default',
						17,
						19,
						21
					]
				},

				fontFamily: {
					options: [
						'default',
						'Arial, Helvetica, sans-serif',
						'Courier New, Courier, monospace',
						'Georgia, serif',
						'Lucida Sans Unicode, Lucida Grande, sans-serif',
						'Tahoma, Geneva, sans-serif',
						'Times New Roman, Times, serif',
						'Trebuchet MS, Helvetica, sans-serif',
						'Verdana, Geneva, sans-serif'
					]
				},

				fontColor: Colors,
				fontBackgroundColor: Colors,
				link: {
					// Automatically add target="_blank" and rel="noopener noreferrer" to all external links.
					addTargetToExternalLinks: true,

					// Let the users control the "download" attribute of each link.
					decorators: [
						{
							mode: 'manual',
							label: 'Downloadable',
							attributes: {
								download: 'download'
							}
						}
					]
				},
				language: 'en',
				heigth: '20rem',
				contentsCss: this.contentsCss,
				stylesSet: 'default',
				format_tags: 'p;h1;h1;h3;h4;h5;h6;pre;address;div;ul',
				format_ul: {
					element: 'ul',
					name: 'list',
					attributes: {
						'class': 'list'
					}
				},
				startupOutlineBlocks: true,
				allowedContent: true,
				templates_replaceContent: false,
				htmlEncodeOutput: false,
				entities: false,
				readOnly: this.isDisabled
			},
			body: ''
		};
	},

	mounted() {
		// this.makeEditor();
		this.init();
		this.registerListeners();

		/* ClassicEditor
	.create( this.$refs[this.identity] )
	.then( editor => {
		console.log( Array.from( editor.ui.componentFactory.names() ) );
	} )
	.catch( error => {
		console.error( error );
	} ); */
	},

	methods: {
		makeEditor() {
			/* this.editor = ClassicEditor.replace(this.$refs[this.identity], {
				...this.default,
				...this.config
			}); */

			this.reset();
			// this.editor.on('update', this.update);
		},

		setData(value) {
			// this.editor.setData(value);
			this.body = value;
		},

		toolbar() {
			return Toolbar[this.config.toolbar || 'full'];
		},

		update() {
			// this.emit(this.editor.getData());
			this.emit(this.body);
		},

		reset() {
			this.setData(this.initialBody);
			this.emit(this.initialBody);
		},

		clear() {
			this.setData('');
			this.emit('');
		}
	},

	computed: {
		computedConfig() {
			return {
				...this.default,
				...this.config
			};
		}
	}/* ,

	watch: {
		isDisabled(isReadOnly) {
			this.editor.setReadOnly(isReadOnly);
		}
	} */
};
</script>
