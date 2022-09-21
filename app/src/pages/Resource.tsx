import * as React from "react";
import { useParams} from "react-router";
import { useNavigate} from "react-router-dom";

const Resource = () => {

    const { id } = useParams();
    const navigate = useNavigate();
    const sampleResource = {"id":{id}, "url":"https://www.google.com"}
    window.open(sampleResource.url, "_blank",)
    return (
      <>{React.useEffect(() => navigate(-1))}</>
    );
};
export default Resource;