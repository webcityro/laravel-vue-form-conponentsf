<template>
	<div v-show="show" :class="computedWrapperCssClass" :style="computedWrapperCssStyle">
		<label
			v-if="label"
			:for="identity"
			:class="computedLabelCssClass"
			:style="computedLabelCssStyle"
		>{{ label }}</label>
		<editor-menu-bar :editor="editor" v-slot="menu">
			<div class="menubar">
				<icon :menu="menu" name="Bold" cmd="bold" img="bold" />
				<icon :menu="menu" name="Italic" cmd="italic" img="italic" />
				<icon :menu="menu" name="Strike" cmd="strike" img="strike" />
				<icon :menu="menu" name="Underline" cmd="underline" img="underline" />
				<icon :menu="menu" name="Code" cmd="code" img="code" />
				<icon :menu="menu" name="Paragraph" cmd="paragraph" img="paragraph" />
				<icon :menu="menu" name="H1" cmd="heading" :args="{ level: 1 }">H1</icon>
				<icon :menu="menu" name="H2" cmd="heading" :args="{ level: 2 }">H2</icon>
				<icon :menu="menu" name="H3" cmd="heading" :args="{ level: 3 }">H3</icon>
				<icon :menu="menu" cmd="bullet_list" name="Unorderd list" img="ul" />
				<icon :menu="menu" cmd="ordered_list" name="Orderd list" img="ol" />
				<icon :menu="menu" cmd="blockquote" name="Quote" img="quote" />
				<icon :menu="menu" cmd="code_block" name="Code" img="code" />
				<icon :menu="menu" cmd="createTable" :args="{rowsCount: 3, colsCount: 3, withHeaderRow: false }" name="table" img="table" />

				<span v-if="menu.isActive.table()">
					<icon :menu="menu" cmd="deleteTable" name="delete_table" img="delete_table" />
					<icon :menu="menu" cmd="addColumnBefore" name="add_col_before" img="add_col_before" />
					<icon :menu="menu" cmd="addColumnAfter" name="add_col_after" img="add_col_after" />
					<icon :menu="menu" cmd="deleteColumn" name="delete_col" img="delete_col" />
					<icon :menu="menu" cmd="addRowBefore" name="add_row_before" img="add_row_before" />
					<icon :menu="menu" cmd="addRowAfter" name="add_row_after" img="add_row_after" />
					<icon :menu="menu" cmd="deleteRow" name="delete_row" img="delete_row" />
					<icon :menu="menu" cmd="toggleCellMerge" name="combine_cells" img="combine_cells" />
				</span>
			</div>
		</editor-menu-bar>
		<editor-content
			:editor="editor"
			:class="computedInputCssClass"
			:style="computedInputCssStyle"
			:disabled="isDisabled"
		/>
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
import { Editor, EditorMenuBar, EditorMenuBubble, EditorContent } from 'tiptap';
import {
	Blockquote,
	CodeBlock,
	HardBreak,
	Heading,
	HorizontalRule,
	OrderedList,
	BulletList,
	ListItem,
	TodoItem,
	TodoList,
	Bold,
	Code,
	Italic,
	Link,
	Table,
	TableHeader,
	TableCell,
	TableRow,
	Strike,
	Underline,
	History
} from 'tiptap-extensions';
import Icon from "./Icon";
import BaseInput from "../BaseInput";

export default {
	mixins: [BaseInput],

	components: {
		EditorContent,
		EditorMenuBar,
		EditorMenuBubble,
		Icon
	},

	data() {
		return {
			initialBody: this.$slots.body ? this.$slots.body[0].children[0].text : '',
			body: '',
			editor: new Editor({
				extensions: [
					new Blockquote(),
					new BulletList(),
					new CodeBlock(),
					new HardBreak(),
					new Heading({ levels: [1, 2, 3] }),
					new HorizontalRule(),
					new ListItem(),
					new OrderedList(),
					new TodoItem(),
					new TodoList(),
					new Link(),
					new Bold(),
					new Code(),
					new Italic(),
					new Table({
						resizable: true,
					}),
					new TableHeader(),
					new TableCell(),
					new TableRow(),
					new Strike(),
					new Underline(),
					new History()
				],
			})
		};
	},

	mounted() {
		// this.init();
		// this.registerListeners();

		// this.editor.on('update', this.update.bind(this));
	},

	beforeDestroy() {
		this.editor.destroy();
	},

	methods: {
		setContent(content) {
			this.editor.setContent(content);
			this.body = content;
		},

		update({getHTML}) {
			this.body = getHTML();
			// this.emit(this.body);
		},

		reset() {
			this.setContent(this.initialBody);
			this.emit(this.initialBody);
		},

		clear() {
			this.setContent('');
			this.emit('');
		},

		enable() {
			this.editor.setOptions({
				editable: true
			});
		},

		disable() {
			this.editor.setOptions({
				editable: false
			});
		}
	}
};
</script>

<style scoped>
.form-control {
    min-height: 15rem;
}

.form-control[disabled] {
    background-color: #e9ecef;
    opacity: 1;
}
</style>
