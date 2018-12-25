/*
|-------------------------------------------------------------------------------
| VUEX modules/brewMethod.js
|-------------------------------------------------------------------------------
| The Vuex data store for the brew methods
*/

/**
 *  status = 0 -> 数据尚未加载
 *  status = 1 -> 数据开始加载
 *  status = 2 -> 数据加载成功
 *  status = 3 -> 数据加载失败
 */

import BrewMethodAPI from '../api/brewMethod.js';
export const brewMethods = {
    state: {
        brewMethods: [],
        brewMethodsLoadStatus: 0,
    },
    actions: {
        loadBrewMethods( { commit } ){
            commit( 'setBrewMethodsLoadStatus', 1 );

            BrewMethodAPI.getBrewMethods()
                .then( function( response ){
                    commit( 'setBrewMethods', response.data );
                    commit( 'setBrewMethodsLoadStatus', 2 );
                })
                .catch( function(){
                    commit( 'setBrewMethods', [] );
                    commit( 'setBrewMethodsLoadStatus', 3 );
                });
        },
    },
    mutations: {
        setBrewMethodsLoadStatus( state, status ){
            state.brewMethodsLoadStatus = status;
        },

        setBrewMethods( state, brewMethods ){
            state.brewMethods = brewMethods;
        }
    },
    getters: {
        getBrewMethods( state ){
            return state.brewMethods;
        },

        getBrewMethodsLoadStatus( state ){
            return state.brewMethodsLoadStatus;
        },

    }

}