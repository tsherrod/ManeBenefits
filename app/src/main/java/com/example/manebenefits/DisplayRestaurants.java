package com.example.manebenefits;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ListView;
import android.widget.TextView;

public class DisplayRestaurants extends Activity implements AdapterView.OnItemClickListener {

    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.display_restaurants);

        ListView listView = (ListView) findViewById(R.id.restaurant_list);
        listView.setOnItemClickListener(this);
    }
    public void onItemClick(AdapterView<?> l, View v, int position, long id) {
        Log.i("HelloListView", "You clicked Item: " + id + " at position:" + position);
        // Then you start a new Activity via Intent
        Intent intent = new Intent();
        switch(position){
            case 0: intent.setClass(this, DisplayRestaurants.class);
                break;
            //case 1: intent.setClass(this, DisplayApparel.class);
            // break;
        }
        intent.putExtra("position", position);
        // Or / And
        intent.putExtra("id", id);
        startActivity(intent);
    }

}
