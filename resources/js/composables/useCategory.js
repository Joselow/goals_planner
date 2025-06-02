import { ref } from 'vue'

import { toast } from 'vue-sonner'

export function useCategory() {
    const loader = ref(false)
    const categories = ref([])

    const getCategories = async () => {
        try {
            loader.value = true
            const { data } = await window.axios({
                method: 'GET',
                url: '/categories'
            })
            
            if (data && Array.isArray(data)) {
                categories.value = data                
            }
            
            console.log(data);
        } catch (error) {
            console.error(error);   
        } finally { loader.value = false }
    }

    const createCategory = async ({ name, color }) => {
        try {
            loader.value = true
            const { data } = await window.axios({
                method: 'POST',
                url: 'categories/create',
                data: { name, color }
            })
            toast.success('Categoría creada correctamente')
            console.log(data);
            // closeCategoryModal()

            return {
                success: true,
                data
            }
        } catch (error) {
            toast.error(error.response?.data?.message)

            return {
                success: false,
                data: null
            }
        } finally { loader.value = false }
    }

    return {
        getCategories,
        categories,
        createCategory,
        loader
    }
}