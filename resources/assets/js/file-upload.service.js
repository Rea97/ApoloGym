import * as axios from 'axios';

const BASE_URL = 'http://apologym.app';

function upload(formData) {
    const url = `/api/profile_picture`;
    return axios.post(url, formData)
    // get data
        .then(x => x.data);
        // add url field
        /**
         .then(x => x.map(img => Object.assign({},
         img, { url: `${BASE_URL}/storage/${img.id}` })));
         */

}

export { upload }