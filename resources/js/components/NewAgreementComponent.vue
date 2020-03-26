<template>
    <div class="w-full h-full bg-white">
        <a-form :form="form" :layout="layout">
            <p class="px-5 text-xl font-sans font-semibold capitalize">
                New Agreement
            </p>
            <a-divider orientation="left">Agreement</a-divider>
            <a-row :gutter="16">
                <a-col :span="24">
                    <a-form-item label="Title">
                        <a-input type="text" v-decorator="['title',{rules: [{required: true, message: 'Please input the opportunity title'}] },]" placeholder="Agreement title"></a-input>
                    </a-form-item>
                </a-col>
            </a-row>
            <a-row :gutter="16">
                <a-col :span="24">
                    <a-form-item label="Purpose">
                        <a-textarea :rows="4" v-decorator="['purpose', { rules: [{required: true, message: 'Please input the purpose of the agreement'}] },]" placeholder="Agreement purpose"></a-textarea>
                    </a-form-item>
                
                </a-col>
             
            </a-row>
            <a-row>
                <a-col :span="12">
                    <a-form-item label="Startdate">
                        <a-date-picker width="200" type="text" v-decorator="['startdate',{rules: [{required: true, message: 'Please input the startdate'}] },]" placeholder="Agreement Startdate"></a-date-picker>
                    </a-form-item>
                </a-col>
                <a-col :span="12">
                    <a-form-item label="Enddate">
                        <a-date-picker type="text" v-decorator="['enddate',{rules: [{required: true, message: 'Please input the enddate'}] },]" placeholder="Agreement Enddate"></a-date-picker>
                    </a-form-item>
                </a-col>
            </a-row>
            <a-divider orientation="left">Agreement Details</a-divider>
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
                            <a-select-option value="research">
                                N/A
                            </a-select-option>
                        </a-select>
                    </a-form-item>
                </a-col>
                <a-col :span="12">
                    <a-form-item label="Partner">
                        <a-select showSearch type="text" v-decorator="['partner_id',{ rules: [{ required: true, message: 'Please select a partner'}]},]" placeholder="Partner">
                            <a-select-option v-for="partner in partnerList" :key="partner.id" :value="partner.id">
                                {{partner.name}}
                            </a-select-option>
                        </a-select>
                    </a-form-item>
                </a-col>
            </a-row>
            <a-row :gutter="16">
                <a-form-item label="Agreement Document">
                    <a-upload-dragger v-decorator="['agreementdoc',{rules: [{ required: false}] },]" name="agreementdoc" :multiple="false" accept=".doc,.docx,.pdf" :customRequest="dummyAction" :beforeUpload="beforeUpload" @change="handleChange">
                        <p class="ant-upload-drag-icon">
                            <a-icon type="inbox" />
                        </p>
                        <p class="ant-upload-text">Click or drag file to this area to upload</p>
                    </a-upload-dragger>
                </a-form-item>
            </a-row>
            <a-row :gutter="16">
                <a-form-item label="Tags">
                    <a-select mode="tags" v-decorator="['tags', {rules: [{required: true, message: 'Please input atleast one tag associated'}] },]" placeholder="Tags e.g "></a-select>
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
            partners: [],
            layout: 'vertical'
        }
    },
    beforeCreate(){
        this.form = this.$form.createForm(this, {name: 'AgreementForm'})
    },
    computed:{
        partnerList() {
            return this.partners
        }
    },
    mounted(){
        axios({
            method: 'get',
            url: '/api/partners'
        }).then((response)=>{
            this.partners = response.data.data
        }).catch((error)=>{
            this.$message.error('Error fetching records')
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
            // Will hold agreemet form values
            let agreementForm
            // Form Data
            const formdata = new FormData
            // Validate and submit
            this.form.validateFields((err,values)=>{
                if(!err){
                    agreementForm = {
                        ...values
                    }
                } else {
                    this.$message.error('Fill in all the required fields')
                }
            })

            // Assign uploads
            const uploads = {
                agreementdoc: agreementForm['agreementdoc'].file
            }

            // Loop through and append to formdata
            Object.keys(agreementForm).forEach(key => formdata.append(key, agreementForm[key]))

            // Add uploads plus form into form
            // This overwrites existing data in formdata
            Object.keys(uploads).forEach(key => formdata.append(key, uploads[key]))

            // Post
            axios({
                method: 'post',
                url: '/api/agreements',
                data: formdata
            }).then((response)=>{
                this.$message.success('Agreement added')
            }).catch((error)=>{
                this.$message.error('Error adding the agreement, check all fields and re-submit the form')
            })

        }
    }
}
</script>