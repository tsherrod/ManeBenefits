package com.example.manebenefits;

import android.app.Activity;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.Typeface;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;

import java.util.List;

public class Categories extends Activity implements AdapterView.OnItemClickListener {

    private ArrayAdapter mAdapter;
    private Typeface mTypeface;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.categories);

        ListView listView = (ListView) findViewById(R.id.category_list);
        listView.setOnItemClickListener(this);

    }
    public void onItemClick(AdapterView<?> l, View v, int position, long id) {
        Log.i("HelloListView", "You clicked Item: " + id + " at position:" + position);
        // Then you start a new Activity via Intent
        Intent intent = new Intent();
        switch(position){
            case 0: intent.setClass(this, DisplayRestaurants.class);
            break;
            case 1: intent.setClass(this, DisplayApparel.class);
            break;
            case 2: intent.setClass(this, DisplayServices.class);
            break;
            case 3: intent.setClass(this, DisplayActivities.class);
            break;
            case 4: intent.setClass(this, DisplayHealthcare.class);
            break;
            case 5: intent.setClass(this, DisplayRentals.class);
            break;

        }
        intent.putExtra("position", position);
        // Or / And
        intent.putExtra("id", id);
        startActivity(intent);
    }

}
