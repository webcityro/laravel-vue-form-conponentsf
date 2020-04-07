const requireComponents = require.context(
	'./components',
	true,
	/Base_[\w-]+\.vue$/
);

requireComponents.keys().forEach(fileName => {
	const componentConfig = requireComponents(fileName);
	const componentName = `sc${_.upperFirst(
		fileName.split('Base_')[1].replace(/\.\w+$/, '')
	)}`;

	Vue.component(componentName, componentConfig.default || componentConfig);
});
