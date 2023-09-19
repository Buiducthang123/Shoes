import router from '../router/index'
import { URLAPI } from '../ultils/config'
import fetchApiData from '../ultils/apiMethod'
import store from '.'
const actions = {
  async fetchProducts({ commit }) {
    const URL = URLAPI + 'products'
    console.log(URL)
    const data = await fetchApiData(URL, 'GET', false, '')
    await commit('setProducts', data.products)
  },
  async fetchCategories({ commit }) {
    const URL = URLAPI + 'category'
    const data = await fetchApiData(URL, 'GET', false, '')
    commit('setCategories', data.categories)
    localStorage.setItem('CategoriesName', JSON.stringify(store.getters.getCategoriesName))
    return store.getters.getCategoriesName
  },
  async fetchColors({ commit }) {
    const URL = URLAPI + 'colors'
    const data = await fetchApiData(URL, 'GET', false, '')
    commit('setColors', data.colors)
  },
  async fetchSizes({ commit }) {
    const URL = URLAPI + 'sizes'
    const data = await fetchApiData(URL, 'GET', false, '')
    commit('setSizes', data.sizes)
  },
  //--------------------------------------------------------------
  //Lấy sản phẩm yêu thích
  async fetchFavoriteProduct({ commit }) {
    const URL = URLAPI + 'favorite'
    const data = await fetchApiData(URL, 'GET', true, '')
    if (data) {
      commit('setFavoriteProduct', data.favorite_products)
    }
  },

  //--------------------------------------------------------------------------------------
  //Xử lý đăng nhập

  async HandleLogin({ commit }, { email, password }) {
    const URL = URLAPI + 'login'
    const data = await fetchApiData(URL, 'POST', false, { email: email, password: password })
    if (data != null) {
      const encodedToken = btoa(data.token) // Mã hoá Base64
      localStorage.setItem('authToken', encodedToken)
      commit('setAuthentication', true)
      commit('setUser', data.user)
      router.push('/')
    } else {
      alert('Đăng nhập không thành cônggg')
    }
  },
  //-----------------------------------------------------------------------
  //KIỂM TRA ĐĂNG NHẬP VỚI TOKEN
  async checkToken({ commit }) {
    const URL = URLAPI + 'user'
    if (localStorage.getItem('authToken') != null) {
      const data = await fetchApiData(URL, 'GET', true)
      if (data) {
        commit('setAuthentication', true)
        commit('setUser', data.user)
      }
    }
  },

  //-----------------------------------------------------------
  //LOGOUT
  async logout({ commit }) {
    const URL = URLAPI + 'logout'
    if (localStorage.getItem('authToken') != null) {
      const data = await fetchApiData(URL, 'POST', true)
      if (data) {
        localStorage.removeItem('authToken')
        commit('setAuthentication', false)
        window.location.assign('/')
      } else {
        console.error('Lỗi đăng xuất')
      }
    }
  },
  //----------------------------------------------------------
  //ĐĂNG KÝ
  async HandleRegister({ commit }, { email, password, phone_number, name }) {
    const URL = URLAPI + 'register'
    const data = await fetchApiData(URL, 'POST', false, {
      email: email,
      password: password,
      phone_number: phone_number,
      name: name
    })
    console.log(data)
    if (data != null) {
      const encodedToken = btoa(data.token) // Mã hoá Base64
      localStorage.setItem('authToken', encodedToken)
      commit('setAuthentication', true)
      commit('setUser', data.user)
      router.push('/')
    } else {
      alert('Đăng ký không thành cônggg')
    }
  },
  //----------------------------------------------------------------------------------------
  //FAVORITE PRODUCT
  //-----------THÊM SẢN PHẨM VÀO DANH SÁCH YÊU THÍCH----------------
  async HandleAddFavorite({ commit }, { user_id, product_id }) {
    const URL = URLAPI + 'favorite'
    const data = await fetchApiData(URL, 'POST', true, {
      user_id: user_id,
      product_id: product_id
    })

    if (data != null) {
      return {
        message: data.message,
        status: true
      }
    }
    return {
      message: errorData.message,
      status: false
    }
  },
  //XÓA SẢN PHẨM KHỎI DANH SÁCH YÊU THÍCH
  async DeleteFavoriteProduct({ commit }, product_id) {
    const URL = URLAPI + `favorite/${product_id}`
    const data = await fetchApiData(URL, 'DELETE', true)
    if (data != null) {
      return {
        message: data.message,
        status: true
      }
    }
    return {
      message: errorData.message,
      status: false
    }
  },
  ///-------------------------------------------------------------------------------------------
  //CART PRODUCTS
  async fetchCarts({ commit }) {
    const URL = URLAPI + 'cart'
    if (localStorage.getItem('authToken') != null) {
      const data = await fetchApiData(URL, 'GET', true)
      if (data) {
        commit('setCarts', data.productsCart)
      }
    }
  },
  //ADD TO CART
  async addToCart({ commit }, { product_id, color_id, size_id, quantity_buy }) {
    const URL = URLAPI + 'cart'
    const data = await fetchApiData(URL, 'POST', true, {
      product_id: product_id,
      color_id: color_id,
      size_id: size_id,
      quantity_buy: quantity_buy
    })

    if (data != null) {
      return {
        status: true,
        message: data.message
      }
    }
    return {
      status: false,
      message: 'Có lỗi xảy ra!!'
    }
  },
  //Delete
  async deleteProductCart({ commit }, { id }) {
    const URL = URLAPI + `cart/${id}`
    const data = await fetchApiData(URL, 'DELETE', true)
    if (data != null) {
      return {
        message: data.message,
        status: true
      }
    }
    return {
      status: false,
      message: 'Có lỗi xảy ra!!'
    }
  },
  //Thay đổi số lượng
  async updateQuantity({ commit }, { id, quantity_buy }) {
    const URL = URLAPI + `cart/${id}`
    const data = await fetchApiData(URL, 'PUT', true, {
      quantity: quantity_buy
    })

    if (data != null) {
      return {
        status: true,
        message: data.message
      }
    }
    return {
      status: false,
      message: 'Có lỗi xảy ra!!'
    }
  }
}

export default actions
