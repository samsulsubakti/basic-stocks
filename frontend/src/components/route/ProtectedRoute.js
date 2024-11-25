import React, { useEffect, useRef } from "react";
import appConfig from "configs/app.config";
import { REDIRECT_URL_KEY } from "constants/app.constant";
import { Navigate, Outlet, useLocation } from "react-router-dom";
import useAuth from "utils/hooks/useAuth";

const { unAuthenticatedEntryPath } = appConfig;

const ProtectedRoute = () => {
  const { authenticated } = useAuth();

  const location = useLocation();

  const fristLoad = useRef(false);

  const { getMe } = useAuth();

  useEffect(() => {
    if (!fristLoad.current) {
      if (authenticated) {
        getMe();
      }
      fristLoad.current = true;
    }
  }, [authenticated, getMe]);

  if (!authenticated) {
    return (
      <Navigate
        to={`${unAuthenticatedEntryPath}?${REDIRECT_URL_KEY}=${location.pathname}`}
        replace
      />
    );
  }

  return <Outlet />;
};

export default ProtectedRoute;
