import superagent from 'superagent'

const agent = superagent.agent();

export const pullDateApi = async (data) => {
    try {
        return await agent.post("/admin/pai/pull_account_data")
            .send(data)
            .set('X-CSRF-TOKEN' , Dcat.token)


        // res.body, res.headers, res.status
    } catch (err) {
        console.error("pullDateApi err",err);
        // err.message, err.response
    }
}


export const testApi = async () => {
    try {
        const res = await agent.get("/admin/pai/test");
        console.log("res",res);
        // res.body, res.headers, res.status
    } catch (err) {
        console.error("testApi err",err);
        // err.message, err.response
    }
}


