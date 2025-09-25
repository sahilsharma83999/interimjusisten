import $ from 'jquery';
import { createApp } from 'vue';

export default function schwerpunkteModule() {
	const app = createApp({
		data() {
			return {
				availableKompetenz: {},
				kompetenz: {
					first: { level1: { options: [], selected: "" }, level2: { options: [], selected: "" }, level3: { options: [], selected: "" } },
					second: { level1: { options: [], selected: "" }, level2: { options: [], selected: "" }, level3: { options: [], selected: "" } },
					third: { level1: { options: [], selected: "" }, level2: { options: [], selected: "" }, level3: { options: [], selected: "" } },
					fourth: { level1: { options: [], selected: "" }, level2: { options: [], selected: "" }, level3: { options: [], selected: "" } },
					fifth: { level1: { options: [], selected: "" }, level2: { options: [], selected: "" }, level3: { options: [], selected: "" } },
				},
				levels: ['level1', 'level2', 'level3'],
				festanstellung: false,
				interimManger: false,
				managementBuyIn: false,
			};
		},
		mounted() {
			const self = this;

			// Receive models
			$.get('/json/kompetenz', function (data) {
				self.availableKompetenz = data;

				Object.keys(self.kompetenz).forEach(row => {
					self.kompetenz[row].level1.options = self.getOptionsArray(data);
				});

				// Load user selections
				$.get('/json/userKompetenz', function (userData) {
					self.loadSelected(userData);
					self.loadWatchers();
				});
			});
		},
		methods: {
			getOptionsArray(data) {
				return Object.keys(data).map(key => ({ value: key, text: data[key].name }));
			},
			loadNextField(level, row, selected) {
				this.kompetenz[row][level].options = this.getOptionsArray(this.findInKompetenz(selected)[0]);
			},
			findInKompetenz(key) {
				const keys = key.split("_");
				let currentKey = keys[0];
				let currentPosition = 1;
				let currentObject = this.availableKompetenz;
				let maxDepth = 0;

				while (Object.keys(currentObject).length !== 0 && maxDepth < 100) {
					for (let i in currentObject) {
						if (i === key) return currentObject[i];
						if (i === currentKey) {
							currentObject = currentObject[i][0];
							currentPosition++;
							currentKey = keys.slice(0, currentPosition).join("_");
							continue;
						}
					}
					maxDepth++;
				}
				return false;
			},
			clearToLevel(level, row) {
				for (let i = this.levels.length - 1; i > level; i--) {
					this.kompetenz[row][this.levels[i]].options = [];
					this.kompetenz[row][this.levels[i]].selected = "";
				}
			},
			loadSelected(data) {
				data.forEach(d => this.loadRow(d));
			},
			loadRow(data) {
				const keys = data.key.split("_");
				const level = keys.length;

				this.kompetenz[data.row].level1.selected = keys[0];

				for (let i = 1; i <= level; i++) {
					const currentKey = keys.slice(0, i).join("_");
					if (i !== level) {
						const nextLevel = `level${i + 1}`;
						this.kompetenz[data.row][nextLevel].options = this.getOptionsArray(this.findInKompetenz(currentKey)[0]);
					}
					this.kompetenz[data.row][`level${i}`].selected = currentKey;
				}
			},
			loadWatchers() {
				const self = this;
				['first', 'second', 'third', 'fourth', 'fifth'].forEach(row => {
					['level1', 'level2'].forEach((level, idx) => {
						this.$watch(`kompetenz.${row}.${level}.selected`, function (value) {
							self.clearToLevel(idx + 1, row);
							self.loadNextField(`level${idx + 2}`, row, value);
						});
					});
				});
			}
		}
	});

	app.mount('#schwerpunkte-view');
	return app;
}
