<template>
    <div class="w-full h-full bg-white">
        <a-form :form="form" :layout="layout" @submit="submitForm">
            <p class="px-5 text-xl font-sans font-semibold capitalize">
                New Partner
            </p>
            <a-divider orientation="left">Partner Details</a-divider>
            <a-row :gutter="16">
                <a-col :span="16">
                    <a-form-item label="Name">
                        <a-input type="text" v-decorator="['name',{rules: [{required: true, message: 'Please input the opportunity title'}] },]" placeholder="Partner's full name"></a-input>
                    </a-form-item>
                </a-col>
                <a-col :span="8">
                    <a-form-item label="Abbreviation">
                        <a-input type="text" v-decorator="['abbreviation', {rules: [{required: true, message: 'Please input abbreviation'}] },]" placeholder="Abbreviation e.g ICRAF, SEI, CIFOR e.t.c"></a-input>
                    </a-form-item>
                </a-col>
            </a-row>
            <a-row :gutter="16">
                <a-col :span="12">
                    <a-form-item label="Type">
                        <a-select showSearch type="text" v-decorator="['type',{ rules: [{ required: true, message: 'Please input the partner type' }] },]" placeholder="Type e.g NGO, For-Profit Organisation, University">
                            <a-select-option value="administrative">
                                NGO
                            </a-select-option>
                            <a-select-option value="finance">
                                University
                            </a-select-option>
                            <a-select-option value="sth">
                                N/A
                            </a-select-option>
                        </a-select>
                    </a-form-item>
                </a-col>
                <a-col :span="12">
                    <a-form-item label="Field">
                        <a-select showSearch type="text" v-decorator="['field',{ rules: [{ required: true, message: 'Please input the opportunity type' }] },]" placeholder="Field">
                            <a-select-option value="administrative">
                                Research
                            </a-select-option>
                            <a-select-option value="finance">
                                Business
                            </a-select-option>
                            <a-select-option value="ict">
                                Policy
                            </a-select-option>
                            <a-select-option value="research">
                                Investors
                            </a-select-option>
                            <a-select-option value="n/a">
                                N/A
                            </a-select-option>
                        </a-select>
                    </a-form-item>
                </a-col>
            </a-row>
            <a-divider orientation="left">Partner Details</a-divider>
            <a-row :gutter="16">
                <a-col :span="8">
                    <a-form-item label="Address">
                        <a-input type="text" v-decorator="['address',{rules: [{required: true, message: 'Please input the contact address of the partner'}] },]" placeholder="Postal Adress e.g 8888 Cummings Vista Apt. 101, Susanbury, NY 95473"></a-input>
                    </a-form-item>
                </a-col>
                <a-col :span="8">
                    <a-form-item label="Location">
                        <a-input type="text" v-decorator="['location',{rules: [{required: true, message: 'Please input the physical location of the partner'}] },]" placeholder="Location e.g Gigiri, Nairobi"></a-input>
                    </a-form-item>
                </a-col>
                <a-col :span="8">
                    <a-form-item label="Country">
                       <a-select showSearch type="text" v-decorator="['country',{ rules: [{ required: true, message: 'Please input the country where the partner is based' }] },]" placeholder="Country e.g Kenya">
                            <a-select-option v-for="country in countryList" :key="country" :value="country">
                                {{country}}
                            </a-select-option>
                        </a-select>
                    </a-form-item>
                </a-col>
            </a-row>
            <a-row :gutter="16">
                <a-form-item label="Purpose">
                    <a-textarea type="text" :rows="4" v-decorator="['purpose']" placeholder="Purpose"></a-textarea>
                </a-form-item>
            </a-row>
            <a-row :gutter="16">
                <a-form-item label="Logo">
                    <a-upload-dragger v-decorator="['partnerimg',{rules: [{ required: false}] },]" name="logo" :multiple="false" accept=".png, .jpg, .jpeg" :customRequest="dummyAction" :beforeUpload="beforeUpload" @change="handleChange">
                        <p class="ant-upload-drag-icon">
                            <a-icon type="inbox" />
                        </p>
                        <p class="ant-upload-text">Click or drag file to this area to upload</p>
                    </a-upload-dragger>
                </a-form-item>
            </a-row>
            <a-row :gutter="16">
                <a-col :span="12">
                    <a-button type="">Cancel</a-button>
                    <a-button type="primary" @click="submitForm"> Submit </a-button>
                </a-col>
            </a-row>
        </a-form>
    </div>
</template>

<script>
export default {
    data(){
        return {
            countries: [],
            layout: 'vertical',
        }
    },
    computed:{
        countryList(){
            return this.countries.map((country)=>{
                return country.name
            })
        }
    },
    beforeCreate(){
        this.form = this.$form.createForm(this, {name: 'PartnerForm'})
    },
    mounted(){
        axios({
            method: 'get',
            url: 'https://restcountries.eu/rest/v2/all'
        }).then((response)=>{
            this.countries = response.data
        }).catch((error)=>{
            console.log(error)
        })
    },
    methods: {
        // Dummy action
        dummyAction(e){
            console.log(e)
            setTimeout(()=>{
                return true
            }, 0)
        },

        // Before upload
        beforeUpload(file){
            return false;
        },
        // Handle change
        handleChange(info) {

            const status = info.file.status;

            if (status !== 'uploading') {
                console.log(info.file, info.fileList);
            }
            if (status === 'done') {
                this.$message.success(`${info.file.name} file uploaded successfully.`);
            } else if (status === 'error') {
                this.$message.error(`${info.file.name} file upload failed.`);
            }
        },
        submitForm(){
            // Prevent default form behavior
            // Form values
            let partnerForm
            // Form data
            const formdata = new FormData()

            // dump form values into formdata
            this.form.validateFields((err,values)=>{
                if (!err){
                    // get values push them to form values
                    partnerForm = {
                        ...values
                    }

                } else {
                    this.$message.error('Fill in all the required fields')
                }
            })

            // Assign uploads
            const uploads = {
                partnerimg: partnerForm['partnerimg'].file
            }

            // Loop through and append to formdata
            Object.keys(partnerForm).forEach(key => formdata.append(key, partnerForm[key]))

            // Add uploads plus form into form
            // This overwrites existing data in formdata
            Object.keys(uploads).forEach(key => formdata.append(key, uploads[key]))

            // Post 
            axios({
                method: 'post',
                url: '/api/partners',
                data: formdata
            }).then((response)=>{
                this.$message.success('Partner added')
            }).catch((error)=>{
                this.$message.error('Error adding partner, check all fields and re-submit')
            })
        }

    }
}
</script>