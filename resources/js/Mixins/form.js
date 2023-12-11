/**
 * Convert object to FormData for submit form
 * @param {mixed} obj
 * @param {string} prefix
 * @param {boolean} indices
 * @param {FormData|null} formData
 */
export function toFormData(obj, prefix = '', { indices = false }, formData = null) {
    formData = formData || new FormData()

    switch (true) {
    case obj === undefined:
        return formData
    case obj === null || obj === '':
        if (!prefix) {
            formData.append(prefix, '')
        }
        break
    case obj instanceof Date:
        formData.append(prefix, obj.toISOString())
        break
    case Array.isArray(obj):
        if (!obj.length) {
            const key = prefix + '[]'

            formData.append(key, '')
        } else {
            obj.forEach((value, index) => {
                const key = prefix + '[' + (indices ? index : '') + ']'

                toFormData(value, key, { indices }, formData)
            })
        }
        break
    case typeof obj === 'object' && !(obj instanceof File) && !(obj instanceof Blob):
        Object.keys(obj).forEach((prop) => {
            const value = obj[prop]

            if (Array.isArray(value)) {
                while (prop.length > 2 && prop.lastIndexOf('[]') === prop.length - 2) {
                    prop = prop.substring(0, prop.length - 2)
                }
            }

            const key = prefix ? prefix + '[' + prop + ']' : prop

            toFormData(value, key, { indices }, formData)
        })
        break
    default:
        formData.append(prefix, obj)
        break
    }

    return formData
}

export default {
    data() {
        return {
            formData: {},
            formErrors: {},
            formResetAfterSubmit: true,
            loadingForm: false,
        }
    },
    methods: {
        async doSubmit() {
            try {
                await this.$refs.form.validate()
            } catch (error) {
                return false
            }


            try {
                await this.submit()
            } catch (error) {
                console.log(error)
                let message = error.response?.data?.message ?? 'Có lỗi trong quá trình thực hiện, vui lòng thử lại sau!'

                if (error.response?.status === 422) {
                    this.setErrors(error.response?.data?.errors ?? {})
                    message = 'Vui lòng kiểm tra lại dữ liệu đầu vào'
                }

                this.$message.error({ message })
                this.loadingForm = false
                return false
            }

            this.$emit('submit', this.formData)
        },
        doReset() {
            this.reset()
            this.$emit('reset')
        },
        reset() {
            this.$refs?.form?.resetFields()
            this.setErrors({})
            this.formData = {}
        },
        setData(data) {
            this.formData = { ...this.formData, ...data }
        },
        getError(field) {
            if (this.hasError(field)) {
                const errors = this.formErrors[field]

                if (Array.isArray(errors)) {
                    return errors[0]
                }

                return errors
            }
        },
        hasError(field) {
            return !!(this.formErrors && this.formErrors[field])
        },
        setErrors(errors) {
            this.formErrors = errors
        },
        addError(field, error) {
            this.formErrors[field] = error
        },
        removeError(field) {
            delete this.formErrors[field]
        },
        prepareForUpload() {
            return toFormData(this.formData, '', { indices: false })
        },
    },
}
