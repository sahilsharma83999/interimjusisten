var $ = require('jquery');
global.jQuery = $;
var Vue = require('vue');

module.exports = function () {
	var vm;
	vm = new Vue({
		el:'#schwerpunkte-view',
		ready: function () {
			var $this = this;
			//Recieve models
			$.get('/json/kompetenz',function (data) {

				$this.availableKompetenz = data;
				for(var i in $this.kompetenz) {
					$this.kompetenz[i].level1.options = $this.getOptionsArray(data);
				}
				//Load User Selections
				$.get('/json/userKompetenz',function(data) {
					$this.loadSelected(data);
					//Load Watchers
					$this.loadWatchers();
				});
			});

		},
		data: {
			availableKompetenz : {},
			kompetenz : {
				first: {
					level1: {
						options:[],
						selected:""
					},
					level2: {
						options:[],
						selected:""
					},
					level3: {
						options:[],
						selected:""
					}
				},
				second: {
					level1: {
						options:[],
						selected:""
					},
					level2: {
						options:[],
						selected:""
					},
					level3: {
						options:[],
						selected:""
					}
				},
				third: {
					level1: {
						options:[],
						selected:""
					},
					level2: {
						options:[],
						selected:""
					},
					level3: {
						options:[],
						selected:""
					}
				},
				fourth: {
					level1: {
						options:[],
						selected:""
					},
					level2: {
						options:[],
						selected:""
					},
					level3: {
						options:[],
						selected:""
					}
				},
				fifth: {
					level1: {
						options:[],
						selected:""
					},
					level2: {
						options:[],
						selected:""
					},
					level3: {
						options:[],
						selected:""
					}
				},
			},
			levels: [
				'level1',
				'level2',
				'level3'
			],
			festanstellung: false,
			interimManger: false,
			managementBuyIn:false,
		},
		methods:{
			getOptionsArray : function (data) {
				var result = [];
				for(var key in data) {
					result.push({value:key,text:data[key].name});
				}
				return result;
			},
			loadNextField:function (level,row,selected) {
				this.kompetenz[row][level].options = this.getOptionsArray(this.findInKompetenz(selected)[0]);
			},
			findInKompetenz: function (key) {
				var keys = key.split("_");
				var currentKey = keys[0];
				var currentPosition = 1;
				var currentObject = this.availableKompetenz;
				var maxDeth = 0;

				while(Object.keys(currentObject).length !== 0 && maxDeth < 100)
				{
					for(var i in currentObject)
					{
						//Return if exact match
						if(i === key) {
							return currentObject[i];
						}
						//change currentObject if partial match
						if(i === currentKey) {
							currentObject = currentObject[i][0];
							currentPosition++;
							currentKey = keys[0];
							for(var it = 1;it < currentPosition;it++) {
								currentKey = currentKey+"_"+keys[it];
							}
							continue;
						}

					}
					maxDeth++;
				}
				return false;
			},
			clearToLevel:function (level,row) {
				for(var i = this.levels.length-1; i > level; i--)
				{
					this.kompetenz[row][this.levels[i]].options = [];
					this.kompetenz[row][this.levels[i]].selected = "";
				}
			},
			loadSelected:function(data) {
				for(var i in data)
				{
					this.loadRow(data[i]);
				}
			},
			loadRow:function(data) {
				var keys = data.key.split("_");
				var level = data.key.split("_").length;

				//Load Level 1
				this.kompetenz[data.row].level1.selected = keys[0];

				//Load remaining levels
				for(var i = 1;i <= level;i++)
				{
					//build current key
					var currentKey = keys[0];
					for(var it = 1;i > it;it++) {
						currentKey = currentKey+"_"+keys[it];
					}

					//Prevent Last level from loading next level options
					if(i != level) {
						var nextLevel = i+1;
						this.kompetenz[data.row]["level"+nextLevel].options = this.getOptionsArray(this.findInKompetenz(currentKey)[0]);
					}

					this.kompetenz[data.row]["level"+i].selected = currentKey;
				}
			},
			loadWatchers:function () {
				var $this = this;
				this.$watch("kompetenz.first.level1.selected", function (value) {
					$this.clearToLevel(1,'first');
					$this.loadNextField('level2','first',value);
				});
				this.$watch("kompetenz.first.level2.selected", function (value) {
					$this.clearToLevel(2,'first');
					$this.loadNextField('level3','first',value);
				});
				this.$watch("kompetenz.second.level1.selected", function (value) {
					$this.clearToLevel(1,'second');
					$this.loadNextField('level2','second',value);
				});
				this.$watch("kompetenz.second.level2.selected", function (value) {
					$this.clearToLevel(2,'second');
					$this.loadNextField('level3','second',value);
				});
				this.$watch("kompetenz.third.level1.selected", function (value) {
					$this.clearToLevel(1,'third');
					$this.loadNextField('level2','third',value);
				});
				this.$watch("kompetenz.third.level2.selected", function (value) {
					$this.clearToLevel(2,'third');
					$this.loadNextField('level3','third',value);
				});
				this.$watch("kompetenz.fourth.level1.selected", function (value) {
					$this.clearToLevel(1,'fourth');
					$this.loadNextField('level2','fourth',value);
				});
				this.$watch("kompetenz.fourth.level2.selected", function (value) {
					$this.clearToLevel(2,'fourth');
					$this.loadNextField('level3','fourth',value);
				});
				this.$watch("kompetenz.fifth.level1.selected", function (value) {
					$this.clearToLevel(1,'fifth');
					$this.loadNextField('level2','fifth',value);
				});
				this.$watch("kompetenz.fifth.level2.selected", function (value) {
					$this.clearToLevel(2,'fifth');
					$this.loadNextField('level3','fifth',value);
				});
			}
		}
	});

	return vm;
};