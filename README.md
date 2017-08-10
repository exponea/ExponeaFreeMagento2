# Exponea Free Extension on Magento 2.0

Welcome to Exponea Free on Magento 2.0 Installation! We're glad that you are interested in our extension.

<h2>New to Magento? Need some help?</h2>
If you're not sure about the following, you probably need a little help before you start installing the Exponea Free extension:

*	Is the Magento software <a href="http://devdocs.magento.com/guides/v2.0/install-gde/basics/basics_magento-installed.html">installed already</a>?
*	What's a <a href="http://devdocs.magento.com/guides/v2.0/install-gde/basics/basics_login.html">terminal, command prompt, or Secure Shell (ssh)</a>?
*	Where's my <a href="http://devdocs.magento.com/guides/v2.0/install-gde/basics/basics_login.html">Magento server</a> and how do I access it?

<h2></h2>
<h2>Step 1: Verify your prerequisites</h2>

Use the following table to verify you have the correct prerequisites to install the Magento software.

<table>
	<tbody>
		<tr>
			<th>Prerequisite</th>
			<th>How to check</th>
			<th>For more information</th>
		</tr>
		<tr>
			<td>Magento version Community Edition 2.0</td>
			<td>Go to admin page, you can see version of Magento 2 at left bottom page, </td>
			<td>Download Magento version Community Edition 2.0 <a href="https://www.magentocommerce.com/download">here</a></td>
		</tr>
		
</tbody>
</table>
<p>If you're not sure how to install Magento 2.0, click <a href="http://blog.magestore.com/install-magento-2-updated-latest-version/">here</a> for tutorial!</p>

<h2>Step 2: Pre-Installation</h2>
The Magento front end relies heavily on caching to provide a faster experience to customer. This is a wonderful tool, but can wreak havoc during the installation process. To ensure that cache is not the cause of any problem, you'd better turn it off. This can be done from the admin console by navigating to the Cache Management page (System->Cache Management), selecting all caches, clicking "disable" from the drop-down menu, and submitting the change.

You also should run the Magento software in developer mode when you’re extending or customizing it. You can use this command line to show current mode :

php bin/magento deploy:mode:show

Use this command to change to developer mode :

php bin/magento deploy:mode:set developer

<h2>Step 3: Install and verify the installation</h2>

-Install by uploading files:

You can download as "zip" file and unzip Exponea Free extension or clone this repository by the following commands:

Use SSH: git clone git@github.com:exponea/ExponeaFreeMagento2.git

Use HTTPS: git clone https://github.com/exponea/ExponeaFreeMagento2.git

When you have completed, you will have a folder named ExponeaFreeMagento2 containing all files of this extension:

Then, please go to the Magento 2 root folder, create the folder app/code/Exponea/ExponeaFree and copy all files to that folder.

Then you open a terminal application, change to magento root directory and use command line :

cd [magento 2 root folder]

php bin/magento setup:upgrade
php bin/magento setup:di:compile

Wait a second to complete installation process.

Finally, coming back to Magento 2 admin to check if Exponea Free extension is installed properly by going to Stores -> Configuration

Copy your public and private tokens in the configuration screen and enable the Exponea Free. We highly recommend you to import your already existing products to Exponea Free. You can do that by clicking on Import products button after setting the private token, enabling Exponea Free and Saving the changes. 

