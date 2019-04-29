package com.example.manebenefits;

import android.content.ActivityNotFoundException;
import android.content.Intent;
import android.net.Uri;
import android.os.AsyncTask;
import android.support.constraint.ConstraintLayout;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ImageButton;
import android.widget.ListView;
import android.widget.TextView;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

public class DisplayRestaurants extends AppCompatActivity {

    ListView listView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.display_restaurants);

        listView = (ListView) findViewById(R.id.restaurant_list);
        listView.setBackgroundColor(getResources().getColor(R.color.lightPurple));

        downloadJSON("http://10.0.0.191/ManeBenefits/getRestaurants.php");
    }


    private void downloadJSON(final String urlWebService) {

        class DownloadJSON extends AsyncTask<Void, Void, String> {

            @Override
            protected void onPreExecute() {
                super.onPreExecute();
            }


            @Override
            protected void onPostExecute(final String s) {
                super.onPostExecute(s);
                //Toast.makeText(getApplicationContext(), s, Toast.LENGTH_SHORT).show();
                try {
                    loadIntoListView(s);
                    listView.setOnItemClickListener(new AdapterView.OnItemClickListener() {

                        public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                            Object o = listView.getItemAtPosition(position);
                            try {
                                display_info(s, position, listView);
                            } catch (JSONException e) {
                                e.printStackTrace();
                            }
                        }
                    });
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }

            @Override
            protected String doInBackground(Void... voids) {
                try {
                    URL url = new URL(urlWebService);
                    HttpURLConnection con = (HttpURLConnection) url.openConnection();
                    StringBuilder sb = new StringBuilder();
                    BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(con.getInputStream()));
                    String json;
                    while ((json = bufferedReader.readLine()) != null) {
                        sb.append(json + "\n");
                    }
                    return sb.toString().trim();
                } catch (Exception e) {
                    return null;
                }
            }
        }
        DownloadJSON getJSON = new DownloadJSON();
        getJSON.execute();

    }

    private void loadIntoListView(String json) throws JSONException {
        JSONArray jsonArray = new JSONArray(json);
        String[] data = new String[jsonArray.length()];
        for (int i = 0; i < jsonArray.length(); i++) {
            JSONObject obj = jsonArray.getJSONObject(i);
            data[i] = obj.getString("name");
        }
        ArrayAdapter<String> arrayAdapter = new ArrayAdapter<String>(this, android.R.layout.simple_list_item_1, data);
        listView.setAdapter(arrayAdapter);

    }

    // Display Info
    // Access when an item is selected from the list of businesses
    // Will display name, address, discount, facebook, instagram, and website if available
    private void display_info(String json, int position, ListView lv) throws JSONException{
        // Begin by setting the transparency for the list of restaurants and the banner to invisible
        // Display the details in separate layout
        lv.setAlpha(0);
        lv.setEnabled(false);
        ConstraintLayout RestaurantBanner = findViewById(R.id.restaurantBanner);
        RestaurantBanner.setAlpha(.2f);
        ConstraintLayout DetailsLayout = findViewById(R.id.details);
        DetailsLayout.setAlpha(1);
        for (int i = 0; i < DetailsLayout.getChildCount(); i++) {
            View child = DetailsLayout.getChildAt(i);
            child.setEnabled(true);
        }

        // Store the data received in a JSON Object
        JSONArray jsonArray = new JSONArray(json);
        String[] data = new String[jsonArray.length()];
        JSONObject obj = jsonArray.getJSONObject(position);

        // store details in selectedBusiness class vars for later access
        final SelectedBusiness selectedBusiness = new SelectedBusiness(obj.getString("name"),
                obj.getString("address"), obj.getString("category"), obj.getString("discount"),
                obj.getString("facebook"), obj.getString("instagram"), obj.getString("website"));

        // Access each TextView and set the corresponding data
        TextView nametv = findViewById(R.id.nameTV);
        final TextView addresstv = findViewById(R.id.addressTV);
        TextView discounttv = findViewById(R.id.discountTV);
        nametv.setAlpha(1);
        nametv.setText(selectedBusiness.getName());
        addresstv.setText(selectedBusiness.getAddress());
        discounttv.setText(selectedBusiness.getDiscount());
        ImageButton instagramBtn = findViewById(R.id.instagramBtn);
        ImageButton facebookBtn = findViewById(R.id.facebookBtn);
        ImageButton websiteBtn = findViewById(R.id.websiteBtn);
        ImageButton closeBtn = findViewById(R.id.closeBtn);

        // When Close button is clicked, close details
        closeBtn.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                ListView lv = findViewById(R.id.restaurant_list);
                lv.setAlpha(1);
                lv.setEnabled(true);
                ConstraintLayout RestaurantBanner = findViewById(R.id.restaurantBanner);
                RestaurantBanner.setAlpha(1);
                ConstraintLayout DetailsLayout = findViewById(R.id.details);
                DetailsLayout.setAlpha(0);
                DetailsLayout.setEnabled(false);
                for (int i = 0; i < DetailsLayout.getChildCount(); i++) {
                    View child = DetailsLayout.getChildAt(i);
                    child.setEnabled(false);
                }
            }
        });

        // check if Instagram account exists
        if (!selectedBusiness.getInstagram().equals("")){
            instagramBtn.setOnClickListener(new View.OnClickListener(){
                @Override
                public void onClick(View v){
                    Uri uri = Uri.parse(selectedBusiness.getInstagram());
                    Intent i= new Intent(Intent.ACTION_VIEW,uri);
                    i.setPackage("com.instagram.android");
                    callInstagram(i);
                }
            });
        }
        else {
            instagramBtn.setEnabled(false);
            instagramBtn.setAlpha(0);
        }
        //check if facebook account exists
        if (!selectedBusiness.getFacebook().equals("")){
            facebookBtn.setOnClickListener(new View.OnClickListener(){
                @Override
                    public void onClick(View v){
                        String url = selectedBusiness.getFacebook();
                        Uri uri = Uri.parse("fb://facewebmodal/f?href=" + url);
                        Intent i= new Intent(Intent.ACTION_VIEW,uri);

                            i.setPackage("com.facebook.katana");
                            callFacebook(i, selectedBusiness);
                }
            });
        }
        else {
            facebookBtn.setEnabled(false);
            facebookBtn.setAlpha(0);
        }
        //check if website exists
        if (!selectedBusiness.getWebsite().equals("")){
            websiteBtn.setOnClickListener(new View.OnClickListener(){
                @Override
                public void onClick(View v){
                    startActivity(new Intent(Intent.ACTION_VIEW,
                            Uri.parse(selectedBusiness.getWebsite())));
                }
            });
        }
        else {
            websiteBtn.setEnabled(false);
            websiteBtn.setAlpha(0);
        }


//        nametv.bringToFront();
//        nametv.setText("HEY");
//        nametv.setText(obj.getString("name"));
//        data[position] = obj.getString("name") + " " + obj.getString("address");
//        name = findViewById(R.id.textView2);
//        nametv.setText(data[position]);

        // Set views clickable
        addresstv.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Uri gmmIntentUri = Uri.parse("geo:0,0?q=" + Uri.encode(addresstv.getText().toString()));
                showMap(gmmIntentUri);
            }
        });


    }

    public void showMap(Uri geoLocation) {
        Intent intent = new Intent(Intent.ACTION_VIEW);
        //geoLocation = Uri.parse("geo:0,0?q=1600+Amphitheatre+Parkway%2C+CA");
        intent.setData(geoLocation);
        if (intent.resolveActivity(getPackageManager()) != null) {
            startActivity(intent);
        }
    }

    private void callInstagram(Intent i) {
        try {
            startActivity(i);
        } catch (ActivityNotFoundException e) {
            startActivity(new Intent(Intent.ACTION_VIEW,
                    Uri.parse("http://instagram.com/xxx")));
        }
    }

    //method to get the right URL to use in the intent
    public void callFacebook(Intent i, SelectedBusiness s) {
        try {
            startActivity(i);
        } catch (ActivityNotFoundException e) {
            startActivity(new Intent(Intent.ACTION_VIEW,
                    Uri.parse(s.getFacebook())));

        }
    }
}