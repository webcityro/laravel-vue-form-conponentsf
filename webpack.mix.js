const mix = require('laravel-mix');
const CKEditorWebpackPlugin = require('@ckeditor/ckeditor5-dev-webpack-plugin');
const { styles } = require('@ckeditor/ckeditor5-dev-utils');

const CKERegex = {
	svg: /ckeditor5-[^/\\]+[/\\]theme[/\\]icons[/\\][^/\\]+\.svg$/,
	css: /ckeditor5-[^/\\]+[/\\]theme[/\\].+\.css/
};

Mix.listen('configReady', webpackConfig => {
	const rules = webpackConfig.module.rules;
	const targetSVG = /(\.(png|jpe?g|gif|webp)$|^((?!font).)*\.svg$)/;
	const targetFont = /(\.(woff2?|ttf|eot|otf)$|font.*\.svg$)/;
	const targetCSS = /\.css$/;

	// exclude CKE regex from mix's default rules
	// if there's a better way to loop/change this, open to suggestions
	for (let rule of rules) {
		if (rule.test.toString() === targetSVG.toString()) {
			rule.exclude = CKERegex.svg;
		} else if (rule.test.toString() === targetCSS.toString()) {
			rule.exclude = CKERegex.css;
		} else if (rule.test.toString() === targetFont.toString()) {
			rule.exclude = CKERegex.svg;
		}
	}
});

mix.webpackConfig({
	plugins: [
		new CKEditorWebpackPlugin({
			language: 'en'
		})
	],
	module: {
		rules: [
			{
				test: CKERegex.svg,
				use: ['raw-loader']
			},
			{
				test: CKERegex.css,
				use: [
					{
						loader: 'style-loader',
						options: {
							injectType: 'singletonStyleTag'
						}
					},
					{
						loader: 'postcss-loader',
						options: styles.getPostCssConfig({
							themeImporter: {
								themePath: require.resolve(
									'@ckeditor/ckeditor5-theme-lark'
								)
							},
							minify: true
						})
					}
				]
			}
		]
	}
});

mix.js('resources/js/app.js', 'public/js')
	.sass('resources/sass/app.scss', 'public/css')
	.sass('resources/sass/editor.scss', 'public/css')
	.sourceMaps()
	.version();
