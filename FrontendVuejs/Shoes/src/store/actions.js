import router from '../router/index'
import fetchAPI from '../ultils/api'
import store from '.'
const actions = {
  async fetchProducts({ commit }) {
    try {
      const data = await fetchAPI('http://127.0.0.1:8000/api/products')
      await commit('setProducts', data.products)
    } catch (error) {
      console.error('Lỗi khi lấy API:', error)
    }
  },
  async fetchCategories({ commit }) {
    try {
      const data = await fetchAPI('http://127.0.0.1:8000/api/category')
      commit('setCategories', data.categories)
      localStorage.setItem('CategoriesName', JSON.stringify(store.getters.getCategoriesName))
      return store.getters.getCategoriesName
    } catch (error) {
      console.error('Lỗi khi lấy API categories:', error)
    }
  },
  async fetchColors({ commit }) {
    try {
      const data = await fetchAPI('http://127.0.0.1:8000/api/colors')
      commit('setColors', data.colors)
    } catch (error) {
      console.error('Lỗi khi lấy API colors:', error)
    }
  },
  async fetchSizes({ commit }) {
    try {
      const data = await fetchAPI('http://127.0.0.1:8000/api/sizes')
      commit('setSizes', data.sizes)
    } catch (error) {
      console.error('Lỗi khi lấy API sizes:', error)
    }
  },
  //--------------------------------------------------------------
  //Lấy sản phẩm yêu thích
  async fetchFavoriteProduct({ commit }) {
    const encodedToken = localStorage.getItem('authToken')
    const decodedToken = atob(encodedToken)

    if (encodedToken) {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/favorite', {
          method: 'GET',
          headers: {
            Authorization: `Bearer ${decodedToken}`
          }
        })
        if (response.ok) {
          const data = await response.json()

          commit('setFavoriteProduct', data.favorite_products)
        } else {
          throw new Error('Error sản phẩm yêu thích')
        }
      } catch (error) {
        console.error(error)
      }
    }
  },

  //--------------------------------------------------------------------------------------
  //Xử lý đăng nhập

  async HandleLogin({ commit }, { email, password }) {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json'
        },
        body: JSON.stringify({
          email: email,
          password: password
        })
      })

      if (response.ok) {
        const data = await response.json()
        const encodedToken = btoa(data.token) // Mã hoá Base64
        localStorage.setItem('authToken', encodedToken)
        commit('setAuthentication', true)
        commit('setUser', data.user)
        router.push('/')
      } else {
        throw new Error('Login failed')
      }
    } catch (error) {
      console.error(error)
    }
  },
  //-----------------------------------------------------------------------
  //KIỂM TRA ĐĂNG NHẬP VỚI TOKEN
  async checkToken({ commit }) {
    const encodedToken = localStorage.getItem('authToken')
    const decodedToken = atob(encodedToken)

    if (encodedToken) {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/user', {
          method: 'GET',
          headers: {
            Authorization: `Bearer ${decodedToken}`
          }
        })
        if (response.ok) {
          const data = await response.json()
          commit('setAuthentication', true)
          commit('setUser', data.user)
        } else {
          throw new Error('Login failed')
        }
      } catch (error) {
        console.error(error)
      }
    }
  },

  //-----------------------------------------------------------
  //LOGOUT
  async logout({ commit }) {
    try {
      const encodedToken = localStorage.getItem('authToken')
      const decodedToken = atob(encodedToken)
      // Gửi yêu cầu POST đến API logout
      const response = await fetch('http://127.0.0.1:8000/api/logout', {
        method: 'POST',
        headers: {
          Authorization: `Bearer ${decodedToken}`
        },
        body: JSON.stringify({
          // Gửi thông tin cần thiết cho API logout (nếu cần)
        })
      })

      if (response.ok) {
        // Xoá token khỏi localStorage
        localStorage.removeItem('authToken')
        commit('setAuthentication', false)
        window.location.assign('/')
      } else {
        console.error('Lỗi đăng xuất')
      }
    } catch (error) {
      console.error(error)
    }
  },
  //----------------------------------------------------------
  //ĐĂNG KÝ
  async HandleRegister({ commit }, { email, password, phone_number, name }) {
    try {
      const response = await fetch('http://127.0.0.1:8000/api/register', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json'
        },
        body: JSON.stringify({
          email: email,
          password: password,
          phone_number: phone_number,
          name: name
        })
      })
      if (response.ok) {
        const data = await response.json()
        const encodedToken = btoa(data.token) // Mã hoá Base64
        localStorage.setItem('authToken', encodedToken)
        commit('setAuthentication', true)

        commit('setUser', data.user)
        router.push('/')
      }
    } catch (error) {
      console.log(error)
    }
  },
  //----------------------------------------------------------------------------------------
  //FAVORITE PRODUCT
  //-----------THÊM SẢN PHẨM VÀO DANH SÁCH YÊU THÍCH----------------
  async HandleAddFavorite({ commit }, { user_id, product_id }) {
    try {
      const encodedToken = localStorage.getItem('authToken')
      const decodedToken = atob(encodedToken)
      // Gửi yêu cầu POST đến API
      const response = await fetch('http://127.0.0.1:8000/api/favorite', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${decodedToken}`
        },
        body: JSON.stringify({
          user_id: user_id,
          product_id: product_id
        })
      })

      if (response.ok) {
        let data = await response.json()

        return {
          message: data.message,
          status: true
        }
      } else {
        let errorData = await response.json()
        console.error('Lỗi Không thêm được:', errorData.message)
        return {
          message: errorData.message,
          status: false
        }
      }
    } catch (error) {
      console.log(error)
      console.log('lỗi')
      return {
        message: 'Yêu thích không thành công',
        status: false
      }
    }
  },
  //XÓA SẢN PHẨM KHỎI DANH SÁCH YÊU THÍCH
  async DeleteFavoriteProduct({ commit }, product_id) {
    try {
      const encodedToken = localStorage.getItem('authToken')
      const decodedToken = atob(encodedToken)
      // Gửi yêu cầu POST đến API
      const response = await fetch(`http://127.0.0.1:8000/api/favorite/${product_id}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${decodedToken}`
        },
        body: JSON.stringify({})
      })

      if (response.ok) {
        let data = await response.json()

        return {
          message: data.message,
          status: true
        }
      } else {
        let errorData = await response.json()
        console.error('Lỗi :', errorData.message)
        return {
          message: errorData.message,
          status: false
        }
      }
    } catch (error) {
      console.log(error)
      console.log('lỗi')
      return {
        message: 'Hủy bỏ yêu thích không thành công',
        status: false
      }
    }
  },
  ///-------------------------------------------------------------------------------------------
  //CART PRODUCTS
  async fetchCarts({ commit }) {
    const encodedToken = localStorage.getItem('authToken')
    const decodedToken = atob(encodedToken)

    if (encodedToken) {
      try {
        const response = await fetch('http://127.0.0.1:8000/api/cart', {
          method: 'GET',
          headers: {
            Authorization: `Bearer ${decodedToken}`
          }
        })
        if (response.ok) {
          const data = await response.json()
          console.log(data)
          commit('setCarts', data.productsCart)
        } else {
          throw new Error('Error')
        }
      } catch (error) {
        console.error(error)
      }
    }
  },
  //ADD TO CART
  async addToCart({ commit }, { product_id, color_id, size_id, quantity_buy }) {
    try {
      const encodedToken = localStorage.getItem('authToken')
      const decodedToken = atob(encodedToken)

      // Gửi yêu cầu POST đến API
      const response = await fetch('http://127.0.0.1:8000/api/cart', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${decodedToken}`
        },
        body: JSON.stringify({
          product_id: product_id,
          color_id: color_id,
          size_id: size_id,
          quantity_buy: quantity_buy
        })
      })

      if (response.ok) {
        let data = await response.json()

        return {
          status: true,
          message: data.message
        }
      } else {
        let errorData = await response.json()
        console.error('Lỗi Không thêm được:', errorData.message)
        return {
          status: false,
          message: 'Có lỗi xảy ra!!'
        }
      }
    } catch (error) {
      console.log(error)
      console.log('lỗi')
      return {
        status: false,
        message: 'Có lỗi xảy ra!!'
      }
    }
  },
  //Delete
  async deleteProductCart({ commit }, { id }) {
    try {
      const encodedToken = localStorage.getItem('authToken')
      const decodedToken = atob(encodedToken)
      let idCart = id
      // Gửi yêu cầu Xóa đến API
      const response = await fetch(`http://127.0.0.1:8000/api/cart/${idCart}`, {
        method: 'DELETE',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${decodedToken}`
        },
        body: JSON.stringify({})
      })

      if (response.ok) {
        let data = await response.json()
        console.log(data)
        return {
          status: true,
          message: data.message
        }
      } else {
        let errorData = await response.json()
        console.error('Lỗi Không thêm được:', errorData.message)
        return {
          status: false,
          message: 'Có lỗi xảy ra!!'
        }
      }
    } catch (error) {
      console.log(error)
      console.log('lỗi')
      return {
        status: false,
        message: 'Có lỗi xảy ra!!'
      }
    }
  },
  //Thay đổi số lượng
  async updateQuantity({ commit }, { id, quantity_buy }) {
    try {
      const encodedToken = localStorage.getItem('authToken');
      const decodedToken = atob(encodedToken);
      const idCart = id;
  
      const response = await fetch(`http://127.0.0.1:8000/api/cart/${idCart}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json',
          Accept: 'application/json',
          Authorization: `Bearer ${decodedToken}`
        },
        body: JSON.stringify({
          quantity: quantity_buy
        })
      });
  
      if (response.ok) {
        const data = await response.json();
        console.log(data);
        return {
          status: true,
          message: data.message
        };
      } else {
        const errorData = await response.json();
        console.error('Lỗi Không thêm được:', errorData.message);
        return {
          status: false,
          message: 'Có lỗi xảy ra!!'
        };
      }
    } catch (error) {
      console.log(error);
      console.log('Lỗi');
      return {
        status: false,
        message: 'Có lỗi xảy ra!!'
      };
    }
  }
  
}

export default actions
