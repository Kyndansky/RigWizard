#uses node (alpine is a lightweight image generally used from react)
FROM node:24-alpine
#tells docker to create some sort of "filesystem" named RigWizardFrontend in this case
WORKDIR /RigWizardFrontend
#copies package,json inside workdir
COPY package.json .
#runs npm install as a command inside the image
RUN npm install
#copies everything from outside the image (basically everything in frontend) inside the workdir
COPY . .
#exposes port 5173
EXPOSE 5173
#effectively starts the image by running npm run dev
CMD [ "npm","run","dev","--","--host"]