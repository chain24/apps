/*
|-------------------------------------------------------------------------------
| VUEX modules/cafes.js
|-------------------------------------------------------------------------------
| The Vuex data store for the cafes
*/

/**
 *  status = 0 -> 数据尚未加载
 *  status = 1 -> 数据开始加载
 *  status = 2 -> 数据加载成功
 *  status = 3 -> 数据加载失败
 */

import CafeAPI from '../api/cafe.js';
export const cafes = {
    state: {
        cafes: [],
        cafesLoadStatus: 0,

        cafe: {},
        cafeLoadStatus: 0,
        cafeAddStatus: 0
    },
    actions: {
        loadCafes( { commit } ){
            commit( 'setCafesLoadStatus', 1 );

            CafeAPI.getCafes()
                .then( function( response ){
                    commit( 'setCafes', response.data );
                    commit( 'setCafesLoadStatus', 2 );
                })
                .catch( function(){
                    commit( 'setCafes', [] );
                    commit( 'setCafesLoadStatus', 3 );
                });
        },
        loadCafe( { commit }, data ){
            commit( 'setCafeLoadStatus', 1 );

            CafeAPI.getCafe( data.id )
                .then( function( response ){
                    commit( 'setCafe', response.data );
                    commit( 'setCafeLoadStatus', 2 );
                })
                .catch( function(){
                    commit( 'setCafe', {} );
                    commit( 'setCafeLoadStatus', 3 );
                });
        },
        addCafe( { commit, state, dispatch }, data ){
            // 状态1表示开始添加
            commit( 'setCafeAddStatus', 1 );

            CafeAPI.postAddNewCafe( data.name, data.address, data.city, data.state, data.zip )
                .then( function( response ){
                    // 状态2表示添加成功
                    commit( 'setCafeAddStatus', 2 );
                    dispatch( 'loadCafes' );
                })
                .catch( function(){
                    // 状态3表示添加失败
                    commit( 'setCafeAddStatus', 3 );
                });
        }
    },
    mutations: {
        setCafesLoadStatus( state, status ){
            state.cafesLoadStatus = status;
        },

        setCafes( state, cafes ){
            state.cafes = cafes;
        },

        setCafeLoadStatus( state, status ){
            state.cafeLoadStatus = status;
        },

        setCafe(state, cafes ){
            state.cafe = cafes;
        },
        setCafeAddStatus(state, status) {
            state.cafeAddStatus = status;
        },
        getCafeAddStatus( state) {
            return state.cafeAddStatus;
        }
    },
    getters: {
        getCafesLoadStatus( state ){
            return state.cafesLoadStatus;
        },

        getCafes( state ){
            return state.cafes;
        },

        getCafeLoadStatus( state ){
            return state.cafeLoadStatus;
        },

        getCafe( state ){
            return state.cafe;
        }
    }

}