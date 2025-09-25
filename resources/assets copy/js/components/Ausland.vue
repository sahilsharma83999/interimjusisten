<template>
    <form
        action="/account/auslands-projekte"
        method="POST"
        accept-charset="utf-8"
    >
        <h1>
            Auslandsprojekte <small>Schritt 2 von 8</small>
            <span v-if="has">
                <div class="btn btn-success" @click.prevent="addRow">
                    <i class="fa fa-plus"></i>
                </div>
                <div class="btn btn-danger" @click.prevent="removeRow">
                    <i class="fa fa-minus"></i>
                </div>
            </span>
        </h1>

        <input type="hidden" name="_token" :value="csrf" />

        <div class="form-group">
            <input
                type="radio"
                id="ausland_yes"
                name="ausland"
                v-model="has"
                :value="1"
                @click="enable"
            />
            <label for="ausland_yes">Ja</label>

            <input
                type="radio"
                id="ausland_no"
                name="ausland"
                v-model="has"
                :value="0"
                @click="purgeAll"
            />
            <label for="ausland_no">Nein</label>
        </div>

        <div
            v-for="(model, index) in models"
            :key="index"
            class="form-group row"
        >
            <input
                type="hidden"
                :name="`projects[${model.id}][id]`"
                v-model="model.id"
            />

            <div class="col-lg-1">
                <label>Monat</label>
                <select
                    class="form-control"
                    v-model="model.fmonth"
                    :name="`projects[${model.id}][fmonth]`"
                >
                    <option v-for="n in 12" :key="n" :value="n">{{ n }}</option>
                </select>
            </div>

            <div class="col-lg-2">
                <label>Jahr</label>
                <select
                    class="form-control"
                    v-model="model.fyear"
                    :name="`projects[${model.id}][fyear]`"
                >
                    <option v-for="year in years" :key="year" :value="year">
                        {{ year }}
                    </option>
                </select>
            </div>

            <div class="col-lg-1">
                <label>Monat</label>
                <select
                    class="form-control"
                    v-model="model.tmonth"
                    :name="`projects[${model.id}][tmonth]`"
                >
                    <option v-for="n in 12" :key="n" :value="n">{{ n }}</option>
                </select>
            </div>

            <div class="col-lg-2">
                <label>Jahr</label>
                <select
                    class="form-control"
                    v-model="model.tyear"
                    :name="`projects[${model.id}][tyear]`"
                >
                    <option v-for="year in years" :key="year" :value="year">
                        {{ year }}
                    </option>
                </select>
            </div>

            <div class="col-lg-3">
                <label>Branche</label>
                <select
                    class="form-control"
                    v-model="model.branche"
                    :name="`projects[${model.id}][branche]`"
                    required
                >
                    <option
                        v-for="(branche, key) in branchen"
                        :key="key"
                        :value="key"
                    >
                        {{ branche }}
                    </option>
                </select>
            </div>

            <div class="col-lg-3">
                <label>Beschreibung</label>
                <textarea
                    class="form-control"
                    v-model="model.description"
                    :name="`projects[${model.id}][description]`"
                ></textarea>
            </div>
        </div>

        <div class="form-group">
            <input
                type="submit"
                class="btn btn-lg btn-primary"
                value="Speichern"
            />
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            models: [],
            row: {
                id: 0,
                fmonth: 1,
                fyear: 1970,
                tmonth: 1,
                tyear: 1970,
                branche: 0,
                description: "",
            },
            has: false,
            years: [],
            branchen: {},
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
        };
    },
    mounted() {
        // Generate years (Carbon::now()->year down to 1900)
        const currentYear = new Date().getFullYear();
        for (let y = currentYear; y >= 1900; y--) {
            this.years.push(y);
        }

        // Fetch initial models
        fetch("/json/ausland")
            .then((res) => res.json())
            .then((data) => {
                if (data.length) {
                    this.models = data.map((item, index) => ({
                        ...item,
                        id: index,
                    }));
                    this.has = true;
                }
            });

        // Fetch branchen list
        fetch("/json/branchen")
            .then((res) => res.json())
            .then((data) => {
                this.branchen = data;
            });
    },
    methods: {
        addRow() {
            const row = { ...this.row, id: this.models.length };
            this.models.push(row);
        },
        removeRow() {
            if (this.models.length > 1) {
                this.models.pop();
            }
        },
        purgeAll() {
            this.has = false;
            this.models = [];
        },
        enable() {
            this.has = true;
            if (this.models.length === 0) {
                this.addRow();
            }
        },
    },
};
</script>
